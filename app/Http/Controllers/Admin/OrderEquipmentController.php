<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Detail_order;
use App\Models\Shipping;
use App\Models\Revision_quot;
use App\Models\Term_payments;
use App\Models\Notes_commercial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;
        $search = $request->q;
        $picId = $request->pic_id;
        $status = $request->status;
        $orderall = Order::with(['items.product', 'items.productadd', 'user', 'pic', 'shipping'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    // Cari di nama customer (relasi user)
                    $q->whereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    })
                        // Cari di kode transaksi
                        ->orWhere('trx_code', 'like', "%{$search}%")
                        // Cari di status order
                        ->orWhere('status', 'like', "%{$search}%")
                        // Cari di tanggal order
                        ->orWhereDate('created_at', 'like', "%{$search}%")
                        // Cari di nama PIC (relasi pic)
                        ->orWhereHas('pic', function ($q3) use ($search) {
                            $q3->where('name', 'like', "%{$search}%");
                        })
                        // Cari di perusahaan (kalau perusahaan ada di relasi user)
                        ->orWhereHas('user', function ($q4) use ($search) {
                            $q4->where('company', 'like', "%{$search}%");
                        })
                        // Cari di perusahaan (kalau perusahaan ada di relasi shipping)
                        ->orWhereHas('shipping', function ($q5) use ($search) {
                            $q5->where('company_destination', 'like', "%{$search}%");
                        })
                        // Cari di perusahaan (kalau perusahaan ada di relasi shipping)
                        ->orWhereHas('shipping', function ($q6) use ($search) {
                            $q6->where('country_destination', 'like', "%{$search}%");
                        })
                        // Cari di perusahaan (kalau perusahaan ada di relasi shipping)
                        ->orWhereHas('shipping', function ($q7) use ($search) {
                            $q7->where('state_destination', 'like', "%{$search}%");
                        });
                });
            })
            ->when($picId, function ($query, $picId) {
                $query->where('pic_id', $picId);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $pics = $pics = User::where('role', 'pic')
            ->whereIn('id', function ($query) {
                $query->select('pic_id')
                    ->from('orders')
                    ->whereNotNull('pic_id');
            })->select('id', 'name')
            ->orderBy('name')
            ->get();


        return view('admin.equipment.order.index', compact('orderall', 'pics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipment.order.add_order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'main_product_id' => 'required|integer',
            'main_qty'        => 'required|numeric|min:1',
            'main_rate'       => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Cek jumlah order dengan status pending
            $pendingCount  = Order::where('user_id', auth()->id())
                ->whereIn('status', [OrderStatusEnum::pending, OrderStatusEnum::processing])
                ->count();

            if ($pendingCount  > 3) {
                return response()->json([
                    'success' => false,
                    'message' => __('Client memiliki lebih dari 3 pesanan yang masih pending atau sedang diproses. Harap selesaikan pesanan tersebut terlebih dahulu.'),
                ], 400);
            }

            // ✅ Hitung total produk utama
            $mainSubtotal = $request->main_qty * $request->main_rate;

            // ✅ Hitung total produk tambahan
            $additionalSubtotal = collect($request->additional_items ?? [])->sum(function ($item) {
                return ($item['qty'] ?? 0) * ($item['rate'] ?? 0);
            });

            $subtotal = $mainSubtotal + $additionalSubtotal;
            $total = $subtotal; // bisa tambahkan shipping kalau perlu

            // ✅ Buat order
            $order = Order::create([
                'user_id' => $request->input('client_id'),
                'created_by' => auth()->id(),
                'subtotal' => $subtotal,
                'total_price' => $total,
                'status' => OrderStatusEnum::pending,
            ]);

            // ✅ Simpan detail produk utama
            Detail_order::create([
                'order_id' => $order->id,
                'product_id' => $request->main_product_id,
                'quantity' => $request->main_qty,
                'product_type' => $request->main_product_type ?? null,
            ]);

            // ✅ Simpan produk tambahan (jika ada)
            if ($request->has('additional_items')) {
                foreach ($request->additional_items as $item) {
                    if (!empty($item['product_id'])) {
                        Detail_order::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['qty'] ?? 1,
                            'productadd_id' => $item['product_id'],
                        ]);
                    }
                }
            }

            // ✅ Tambah shipping jika aktif
            if ($request->boolean('use_shipping_to_onsite')) {
                Shipping::create([
                    'order_id' => $order->id,
                    'use_shipping_to_onsite' => true,
                    'type_transportation' => $request->input('type_transportation') 
                        ?? ($request->input('volume_m3') > 28 ? '40 Feet' : '20 Feet'),

                    'weight_kg' => $request->input('weight_kg'),
                    'volume_m3' => $request->input('volume_m3'),
                    'shipping_cost' => $request->input('shipping_cost'),

                    // bagian alamat dan perusahaan
                    'company_destination' => $request->input('shipping_to_company'),
                    'state_destination' => $request->input('shipping_state'),
                    'country_destination' => $request->input('shipping_country'),
                    'district_destination' => $request->input('shipping_district'),
                    'address_destination' => $request->input('shipping_to_address'),
                ]);
            }

            // ✅ Buat revision default
            Revision_quot::create([
                'order_id' => $order->id,
                'revision_number' => 0,
                'revision_description' => 'Quotation First Issue',
            ]);

            // ✅ Buat term payment default
            Term_payments::create([
                'order_id' => $order->id,
                'payment_description' => '<ul><li>Payment–1: 30% Down Payment, Start Fabrication</li><li>Payment–2: 70% after Ready to Dispatch from Workshop</li></ul>',
            ]);

            // ✅ Buat note commercial default
            Notes_commercial::create([
                'order_id' => $order->id,
                'notes_description' => '<p>-</p>',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat',
                'data'    => $order,
            ]);

                

                // return response()->json([
                //     'success' => true,
                //     'message' => __('Produk berhasil dihapus dari keranjang'),
                //     'data'    => $order->uuid,
                // ]);
        } catch (\Throwable $th) {
            // DB::rollBack();
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
            // ], 500);

            // Tambahkan log agar bisa dilihat di storage/logs/laravel.log
            Log::error('Order Store Error: ' . $th->getMessage(), [
                'trace' => $th->getTraceAsString(),
            ]);

            // Untuk sementara tampilkan langsung error-nya ke respon (agar cepat debug)
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $orderdetail = Order::with(['items.product',  'items.productadd', 'pic', 'user', 'shipping', 'termpayment', 'revisiquotation'])->findOrFail($id);
            $firstItem = $orderdetail->items[0];
            $product = $firstItem->product;
            $productId = $firstItem->product_id;
            $productTypeId = $firstItem->product_type;

            // Daftar semua jenis spesifikasi yang mungkin
            $specificationTypes = [
                'specificationFas',
                'specificationFmp',

            ];

            $productMainSpecification = null;


            foreach ($specificationTypes as $type) {
                if ($product->{$type}->isNotEmpty()) {
                    $productMainSpecification = $product->{$type}->where('id', $productTypeId)->first();
                    break;
                }
            }

            if (!$productMainSpecification) {
                dd('Spesifikasi tidak ditemukan untuk produk ini.');
            }

            // dd($orderdetail);

            return view('admin.equipment.order.show', compact('orderdetail', 'productMainSpecification'));
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $order = Order::where('id', $id)->select('id')->firstOrFail();
            $order->status = $request->input('status');
            $order->save();
            Session()->flash('status', 'Order status update.');

            return response()->json([
                'success' => true,
                'message' => 'Order status update.',
                'data'    => $order,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Kirim email specified resource from storage.
     */
    public function sendEmailAndRedirect($id)
    {
        // dd($order->user->email);
        $order = Order::find($id);
        $userEmail = $order->user->email;

        if ($order) {
            $order->status = OrderStatusEnum::submission;
            $order->save();
        }

        return redirect()->away("mailto:$userEmail");
    }
}
