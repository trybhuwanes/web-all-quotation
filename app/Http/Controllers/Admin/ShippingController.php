<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\priceService;

class ShippingController extends Controller
{
    protected $priceService;

    // Menggunakan dependency injection untuk OrderService
    public function __construct(priceService $priceService)
    {
        $this->priceService = $priceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'shipping_cost' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            $shipping = Shipping::where('id', $id)->select('id', 'order_id', 'shipping_cost')->firstOrFail();
            $shipping->shipping_cost = $request->input('shipping_cost');
            $shipping->save();

            $order = Order::where('id', $shipping->order_id)->with(['items'])->firstOrFail();
            // Hitung ulang total harga berdasarkan biaya pengiriman dan diskon
            $order->total_price = $this->priceService->recalculateTotalPrice($order);

            // if($order->shipping){
            //     $oldShippingCost = $order->shipping->shipping_cost;
            //     // $order->total_price = max(0, $order->total_price - $oldShippingCost + $shipping->shipping_cost);
            // }

            $order->save();

            DB::commit();

            Session()->flash('status', 'Biaya pengiriman berhasil diperbarui.');

            return response()->json([
                'success' => true,
                'message' => 'Biaya pengiriman berhasil diperbarui.',
                'data'    => $shipping,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }

    public function updateWeight(Request $request, string $id)
    {
        try {
            $request->validate([
                'weight_kg' => 'required|numeric|min:0',
                'volume_m3' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            $shipping = Shipping::where('id', $id)->select('id', 'order_id', 'weight_kg', 'volume_m3')->firstOrFail();
            $shipping->weight_kg = $request->input('weight_kg');
            $shipping->volume_m3 = $request->input('volume_m3');
            $shipping->save();

            DB::commit();

            Session()->flash('status', 'Berat dan volume berhasil diperbarui.');

            return response()->json([
                'success' => true,
                'message' => 'Berat dan volume berhasil diperbarui.',
                'data'    => $shipping,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
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
}
