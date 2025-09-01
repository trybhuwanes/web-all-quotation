<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\priceService;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class GivediscountsController extends Controller
{
    //
    protected $priceService;

    public function __construct(priceService $priceService)
    {
        $this->priceService = $priceService;
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->all());
        try {
            DB::beginTransaction();
            $order = Order::where('id', $id)->firstOrFail();
            // Update the status

            if ($order) {
                // Update nilai diskon dan jenis diskon
                $order->discount_amount = $request->input('discount_amount');

                // Hitung ulang total harga berdasarkan biaya pengiriman dan diskon
                $order->total_price = $this->priceService->recalculateTotalPrice($order);
                $order->save();
                DB::commit();
                Session()->flash('status', 'Diskon berhasil diperbarui.');

                return response()->json([
                    'success' => true,
                    'message' => 'Diskon berhasil diperbarui.',
                    'data'    => $order,
                ]);
        
            }
            return response()->json(['message' => 'Order Tidak Ditemukan.']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }

    }
}
