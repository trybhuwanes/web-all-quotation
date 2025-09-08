<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderadminController extends Controller
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


        return view('admin.order-admin.index', compact('orderall', 'pics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

            return view('admin.order-admin.show', compact('orderdetail', 'productMainSpecification'));
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
