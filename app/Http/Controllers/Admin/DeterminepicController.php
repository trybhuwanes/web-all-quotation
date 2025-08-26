<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DeterminepicController extends Controller
{
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
        //
        try {
            $order = Order::where('id', $id)->select('id','status')->firstOrFail();
            $order->pic_id = $request->input('picid');
            if ($order->status == OrderStatusEnum::pending->value) {
                $order->status = OrderStatusEnum::processing;
            }
            $order->save();
            Session()->flash('status', 'PIC Berhasil Ditentukan.');

            return response()->json([
                'success' => true,
                'message' => 'PIC Berhasil Ditentukan.',
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
}
