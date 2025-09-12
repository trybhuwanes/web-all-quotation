<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdditionalproductService;
use App\Services\priceService;
use App\Models\Cart;
use App\Models\Detail_cart;
use App\Models\Detail_order;
use App\Models\Order;
use App\Models\Product;

class CartpicController extends Controller
{
    //
    protected $priceService;
    public $additionalproductService;

    public function __construct(AdditionalproductService $additionalproductService, priceService $priceService)
    {
        $this->additionalproductService = $additionalproductService;
        $this->priceService = $priceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter['search'] = $request->q;
        $carts = Cart::where('user_id', auth()->id())
            ->with([
                'items.product.specificationFas',
                'items.product.specificationFmp',
                'items.productadd'
            ])->get();

        // dd($carts);
        // Memastikan ada item di dalam keranjang
        if ($carts->isNotEmpty() && $carts[0]->items->isNotEmpty()) {
            $firstItem = $carts[0]->items[0]; // Mengambil item pertama dari keranjang
            $product = $firstItem->product; // Mengambil produk dari item
            // dd($firstItem);
            // Mengambil product_id dari item tersebut
            $productId = $firstItem->product_id;
            // Mengambil product_type dari item tersebut
            $productTypeId = $firstItem->product_type;

            // Cek apakah produk menggunakan relasi specificationFas atau specificationFmp
            if ($product->specificationFas->isNotEmpty()) {
                // Menggunakan spesifikasi FAS berdasarkan product_type_id
                $specification = $product->specificationFas->where('id', $productTypeId)->first();
            } elseif ($product->specificationFmp->isNotEmpty()) {
                // Menggunakan spesifikasi FMP berdasarkan product_type_id
                $specification = $product->specificationFmp->where('id', $productTypeId)->first();
            } else {
                // Tidak ada spesifikasi ditemukan
                dd('Produk Tidak Di Temukan');
            }

            $totalVolume = $this->totalM3($specification) * $firstItem->quantity;
            $totalKg = $this->totalKg($specification) * $firstItem->quantity;
            // dd($totalVolume);

            if ($totalVolume > 28) {
                # code...
                // dd('40 FT');
            } else {
                # code...
                // dd('20 FT');
            }

            // dd();
            $additionalproducts = $this->additionalproductService
                ->filtering($filter)
                ->where('product_id', $productId)
                ->orderBy('created_at', 'asc')
                ->paginate(9);

            // Debugging informasi
        } else {
            // dd('Tidak Ada items Produk');
            return view('customer.cart-empty');
        }
        return view('customer.mycart', compact('additionalproducts', 'carts', 'specification', 'totalVolume', 'totalKg'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        try {
            // $cart = Cart::where('user_id', auth()->id())->with('items')->first();

            $cart = Cart::where('user_id', auth()->id())
                ->where('id', $id) // Mengambil cart berdasarkan user_id dan id cart
                ->with('items')
                ->first();
            $cart->items()->delete();
            $cart->delete();
            // $kategori = Category_product::findOrFail($id);
            // $this->kategoriproductService->destroy($kategori);
            Session()->flash('status', __('Keranjang Dihapus'));

            return response()->json([
                'success' => true,
                'message' => __('Keranjang Berhasil Dihapus'),
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }


    public function addToCart(Request $request, Product $product)
    {
        // dd($request->all());
        $productId = $request->input('product_id');
        $productType = $request->input('product_type');
        // Gunakan 1 sebagai default quantity jika tidak diberikan
        $quantity = $request->quantity ? $request->quantity : 1;
        // Mendapatkan cart berdasarkan user_id atau membuat yang baru jika belum ada
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // Mencari detail cart item berdasarkan cart_id dan product_id
        $cartItem = Detail_cart::where('cart_id', $cart->id)->where('product_id', $productId)->where('product_type', $productType)->first();
        // dd($cartItem);

        if ($cartItem) {
            // Jika item sudah ada di keranjang, tambahkan quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Jika item belum ada di keranjang, tambahkan item baru
            Detail_cart::create([
                'cart_id' => $cart->id,
                'product_id' =>  $request->product_id,
                'product_type' =>  $request->product_type,
                'productadd_id' =>  null,
                'quantity' => $quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Dimasukan Ke Keranjang');
    }

    public function deleteFromCart(string $id)
    {
        // dd($id);
        try {
            // Temukan item dalam keranjang berdasarkan ID
            $itemCart = Detail_order::findOrFail($id);

            if ($itemCart) {
                // Ambil order terkait item yang dihapus
                $order = $itemCart->order;

                // Hapus item dari keranjang
                $itemCart->delete();

                // Hitung ulang total harga
                if ($order) {
                    $order->total_price = $this->priceService->recalculateTotalPrice($order);
                    $order->save(); // Simpan perubahan total harga ke database
                }

                // Kirim respons sukses
                Session()->flash('status', __('Produk berhasil dihapus dari keranjang'));
                return response()->json([
                    'success' => true,
                    'message' => __('Produk berhasil dihapus dari keranjang'),
                    'data'    => $id,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('Produk tidak ditemukan di keranjang'),
                    'data'    => $id,
                ]);
            }
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }


    public function addAdditionalProductToCart(Request $request)
    {
        // $productName = $request->input('product_name');
        // $productPrice = $request->input('product_price');
        $productId = $request->input('productadd_id');
        $orderId = $request->input('o_id');
        $quantity = $request->quantity ? $request->quantity : 1;
        // dd($orderId);

        // Mendapatkan cart berdasarkan user_id atau membuat yang baru jika belum ada
        // $order = Order::where('user_id', auth()->id())->first();
        // Check if the product already exists in the user's cart
        $existingCartItem = Detail_order::where('order_id', $orderId)
            ->where('productadd_id', $productId)
            ->first();
        // dd($existingCartItem);

        if ($existingCartItem) {
            // If it exists, update the quantity
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            // If it doesn't exist, create a new cart item
            Detail_order::create([
                'order_id' => $orderId,
                'product_id' =>  null,
                'productadd_id' =>  $productId,
                'quantity' => $quantity
            ]);
        }

        $order = Order::find($orderId);

        // Hitung ulang total harga
        if ($order) {
            $order->total_price = $this->priceService->recalculateTotalPrice($order);
            $order->save(); // Simpan perubahan total harga ke database
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateAdditionalProductPrice(Request $request, $id)
    {
        $request->validate([
            'custom_price' => 'required|numeric|min:0',
        ]);

        $item = Detail_order::findOrFail($id);
        $item->custom_price = $request->custom_price;
        $item->save();

        $order = $item->order;
        if ($order) {
            $order->total_price = $this->priceService->recalculateTotalPrice($order);
            $order->save();
        }

        return redirect()->back()->with('success', 'Harga produk tambahan berhasil diperbarui!');
    }

    public function updateQuantity(Request $request)
    {
        // dd($request->all());
        try {
            $itemId = $request->input('id');
            $action = $request->input('action');

            // Ambil item dari cart berdasarkan id
            $cartItem = Detail_cart::find($itemId);

            if ($action === 'increase') {
                $cartItem->quantity += 1;
            } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }

            // Simpan perubahan
            $cartItem->save();
            Session()->flash('status', 'Berhasil ditambah');

            return response()->json([
                'success' => true,
                'message' => 'Additional Prodcut updated.',
                'data'    => null,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }




    // Ngitung 
    function beratKg($specification)
    {
        if (isset($specification->dimens_p, $specification->dimens_l, $specification->dimens_t)) {
            return ($specification->dimens_p * $specification->dimens_l * $specification->dimens_t) / 4000;
        }

        return null; // Return null jika salah satu nilai tidak tersedia
    }

    // Ngitung 
    function beratVolume($specification)
    {
        if (isset($specification->dimens_p, $specification->dimens_l, $specification->dimens_t)) {
            return ($specification->dimens_p * $specification->dimens_l * $specification->dimens_t) / 1000000;
        }

        return null; // Return null jika salah satu nilai tidak tersedia
    }

    function totalM3($specification)
    {
        if (isset($specification->floater_kubikasi, $specification->motor_kubikasi)) {
            return $specification->floater_kubikasi + $specification->motor_kubikasi;
        }
        return null;
    }

    function totalKg($specification)
    {
        if (isset($specification->floater_kg, $specification->motor_kg)) {
            return $specification->floater_kg + $specification->motor_kg;
        }
        return null;
    }
}
