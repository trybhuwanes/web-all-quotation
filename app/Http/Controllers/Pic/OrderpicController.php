<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Enums\OrderStatusEnum;
use App\Models\Additional_product;

class OrderpicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->q;
        $status = $request->status;
        $loggedInPicId = auth()->user()->id;

        $orderall = Order::with(['items.product', 'items.productadd', 'user', 'revisiquotation',])
            ->where('pic_id', $loggedInPicId)
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
                        });
                });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pic.order-pic.index', compact('orderall'));
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
            $orderdetail = Order::with(['items.product', 'items.productadd', 'user', 'shipping', 'revisiquotation'])->findOrFail($id);


            $firstItem = $orderdetail->items[0]; // Mengambil item pertama dari pesanan
            $product = $firstItem->product; // Mengambil produk dari item
            $productId = $firstItem->product_id;

            $productTypeId = $firstItem->product_type;

            // Daftar semua jenis spesifikasi yang mungkin
            $specificationTypes = [
                'specificationFas',
                'specificationFmp',
                // Tambahkan tipe spesifikasi lainnya di sini
            ];

            $productMainSpecification = null;

            // Loop melalui setiap tipe spesifikasi dan ambil yang cocok
            foreach ($specificationTypes as $type) {
                if ($product->{$type}->isNotEmpty()) {
                    $productMainSpecification = $product->{$type}->where('id', $productTypeId)->first();
                    break; // Hentikan loop begitu spesifikasi ditemukan
                }
            }

            if (!$productMainSpecification) {
                dd('Spesifikasi tidak ditemukan untuk produk ini.');
            }


            // Ambil semua product_add berdasarkan tipe produk

            $allProductAdds = Additional_product::where('product_id', $productId)->get();

            // Ambil ID product_add yang sudah ada dalam pesanan
            $addedProductAddIds = $orderdetail->items->pluck('productadd.id')->filter()->toArray();
            // $addedProductAddIds = $orderdetail->items->pluck('productadd.id')->toArray();

            // Filter product_add yang belum ditambahkan
            $availableProductAdds = $allProductAdds->whereNotIn('id', $addedProductAddIds);
            // dd($availableProductAdds);


            return view('pic.order-pic.show', compact('orderdetail', 'productMainSpecification', 'availableProductAdds'));
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
            Session()->flash('status', 'Status Order terupdate.');

            return response()->json([
                'success' => true,
                'message' => 'Status Order terupdate.',
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
