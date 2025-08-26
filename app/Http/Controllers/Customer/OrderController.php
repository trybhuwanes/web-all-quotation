<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Detail_cart;
use App\Models\Order;
use App\Models\Detail_order;
use App\Enums\OrderStatusEnum;
use App\Models\Notes_commercial;
use App\Models\Product;
use App\Models\Revision_quot;
use App\Models\Shipping;
use App\Models\Term_payments;
use App\Services\ProductService;

class OrderController extends Controller
{
    public $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // 
    public function checkout(Request $request)
    {
        // dd($request->all());
        try {
            // Cek apakah user memiliki order dengan status pending
            $existingPendingOrder = Order::where('user_id', auth()->id())
                ->whereIn('status', [OrderStatusEnum::pending, OrderStatusEnum::processing])
                ->first();

            if ($existingPendingOrder) {
                return response()->json([
                    'success' => false,
                    'message' => __('Anda memiliki pesanan yang masih pending atau sedang diproses. Harap selesaikan pesanan tersebut terlebih dahulu.'),
                ], 400);
            }

            // Mengambil cart dari user yang sedang login
            $cart = Cart::where('user_id', auth()->id())
                ->with(['items.product.specificationFas', 'items.product.specificationFmp', 'items.productadd'])
                ->first();
            
            if ($cart && $cart->items->isNotEmpty()) {
                $totalPrice = $cart->items->sum(function($item) {
                    $product = $item->product;
                    $productTypeId = $item->product_type;

                    if ($product) {
                        $specificationTypes = [
                            'specificationFas',
                            'specificationFmp',
                        ];
                
                        $productMainSpecification = null;
                        $priceFromSpecification = null;

                        foreach ($specificationTypes as $type) {
                            if ($product->{$type}->isNotEmpty()) {
                                $productMainSpecification = $product->{$type}->where('id', $productTypeId)->first();
                                if ($productMainSpecification) {
                                    $priceFromSpecification = $productMainSpecification->harga;
                                    break;
                                }
                            }
                        }

                        if ($priceFromSpecification) {
                            return $priceFromSpecification * $item->quantity;
                        }
                    }

                    if ($item->productadd) {
                        return $item->productadd->harga_produk_tambahan * $item->quantity;
                    }

                    return 0;
                });

                // Hitung biaya pengiriman jika dipilih shipping_to_onsite
                $shippingCost = 0;
                if ($request->boolean('use_shipping_to_onsite')) {
                    // $shippingCost = $this->calculateShippingCost($request->input('total_volume'), $request->input('total_kg'));
                    $totalPrice += $shippingCost;
                }

                // Create order
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total_price' => $totalPrice,
                    'status' => OrderStatusEnum::pending,
                ]);

                // Insert detail order
                foreach ($cart->items as $item) {
                    Detail_order::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_type' => $item->product_type,
                        'productadd_id' => $item->productadd_id,
                        'quantity' => $item->quantity,
                    ]);
                }

                if ($request->boolean('use_shipping_to_onsite')){
                    Shipping::create([
                        'order_id' => $order->id,
                        'use_shipping_to_onsite' => true,
                        'type_transportation' => $request->input('total_volume') > 28 ? '40 Feet' : '20 Feet',
                        'weight_kg' => $request->input('total_volume'),
                        'volume_m3' => $request->input('total_kg'),
                        'state_destination' => $request->input('provinsi'),
                        'country_destination' => $request->input('kota'),
                        'address_destination' => $request->input('address_destination'),
                        'shipping_cost' => 0,
                        // 'destination address' => auth()->user()->location_company,
                    ]);
                }

                Revision_quot::create([
                    'order_id' => $order->id,
                    'revision_number' => '0',
                    'revision_description' => 'Quotation First Issue',
                ]);

                Term_payments::create([
                    'order_id' => $order->id,
                    'payment_description' =>'<ul><li>Payment–1: 30% Down Payment, Start Fabrication</li><li>Payment–2: 70% after Ready to Dispatch from Grinviro Workshop</li></ul>',
                ]);

                Notes_commercial::create([
                    'order_id' => $order->id,
                    'notes_description' =>'<p>-</p>',
                ]);

                // Kosongkan cart
                $cart->items()->delete();
                $cart->delete();
                Session()->flash('status', __('Produk berhasil dihapus dari keranjang'));

                return response()->json([
                    'success' => true,
                    'message' => __('Produk berhasil dihapus dari keranjang'),
                    'data'    => $order->uuid,
                ]);
            } else {
                return redirect()->back()->with('error', 'Keranjang Kosong!');
            }
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }



    public function myOrder()
    {
        $myorderall = Order::where('user_id', auth()->id())->with('items')->get();
        $products = $this->productService->model()
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
        return view('customer.order_list', compact('myorderall', 'products'));
    }

    public function orderDetail(string $code)
    {
        
        $orderfind = Order::where('uuid', $code)->where('user_id', auth()->id())
                                                    ->with(['user', 'shipping', 'items.product', 
                                                    'items.productadd'])->first();
        if (!$orderfind) {
            abort(404, 'Order not found');
        }
                                             
        // Memastikan ada items dalam pesanan
        if ($orderfind->items->isNotEmpty()) {
            $firstItem = $orderfind->items[0]; // Mengambil item pertama dari pesanan
            // dd($firstItem->product_id);
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
    
            // Mengambil produk tambahan berdasarkan ID produk
            return view('customer.order_detail', compact('orderfind', 'productMainSpecification'));
        } else {
            dd('Tidak ada items dalam pesanan.');
        }
        
    }

    public function thankyou()
    {
        $order = Order::select('id')
            ->where('user_id', auth()->id())
            ->first();
        return view('customer.thankyou');
    }

    public function checkoutOld()
    {
        try {

            //
            // $carts = Cart::where('user_id', auth()->id())->with(['items.product', 'items.productadd'])->first();
            $cart = Cart::where('user_id', auth()->id())->with('items')->first();
            
            

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->back()->with('error', 'Keranjang Kosong!');
            }

            $totalPrice = $cart->items->sum(function($item) {
                if ($item->product) {
                    return $item->product->harga * $item->quantity;
                } elseif ($item->productadd) {
                    return $item->productadd->harga_produk_tambahan * $item->quantity;
                }
            });
        
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => OrderStatusEnum::pending,
            ]);

            foreach ($cart->items as $item) {
                Detail_order::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'productadd_id' => $item->productadd_id,
                    'quantity' => $item->quantity,
                    
                ]);
            }

            // Kosongkan cart
            $cart->items()->delete();
            $cart->delete();
            Session()->flash('status', __('Produk berhasil dihapus dari keranjang'));

            return response()->json([
                'success' => true,
                'message' => __('Produk berhasil dihapus dari keranjang'),
                'data'    => $order->trx_code,
            ]);

        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
        
    }
}
