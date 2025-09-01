<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term_payments;
use Illuminate\Http\Request;

class TermpaymentController extends Controller
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
        $term = Term_payments::where('id', $id)->with('order')->first();
        return view('admin.order-admin.edit_term', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $term = Term_payments::findOrFail($request->id);
            $term->payment_description = $request->input('payment_description');
            $term->save();

            // $product = $this->productService->update($request->all(), $productData);
            Session()->flash('status', 'Kebijakan di Simpan.');

            return response()->json([
                'success' => true,
                'message' => 'Kebijakan di Simpan.',
                'data'    => $term,
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
