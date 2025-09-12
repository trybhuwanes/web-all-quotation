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
        $request->validate([
            'discount_type'   => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::with('items', 'shipping')->findOrFail($id);

            // Simpan tipe dan nilai diskon
            $order->discount_type = $request->input('discount_type');
            $order->discount_amount = $request->input('discount_amount');

            // Recalculate total
            $order->total_price = $this->priceService->recalculateTotalPrice($order);
            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Diskon berhasil diperbarui.',
                'data'    => $order,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }
    }
}
