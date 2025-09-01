<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Additional_product;
use App\Services\AdditionalproductService;

class AdditionalproductpicController extends Controller
{
    public $additionalproductService;
    
    public function __construct(AdditionalproductService $additionalproductService)
    {
        $this->additionalproductService = $additionalproductService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter['search']= $request->q;
        $additionalproducts       = $this->additionalproductService
                                    ->filtering($filter)
                                    ->with('product')
                                    ->orderBy('created_at', 'asc')
                                    ->paginate(10);

        // dd($additionalproducts);
        return view('pic.product-additional.index', compact('additionalproducts'));
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
        $additionalproducts = Additional_product::where('uuid', $id)->first();
        return view('pic.product-additional.edit_product', compact('additionalproducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $additionalproducts = Additional_product::where('uuid', $id)->first();
        return view('pic.product-additional.edit_product', compact('additionalproducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $additionalproductData = Additional_product::findOrFail($request->id);
            $additionalproduct = $this->additionalproductService->update($request->all(), $additionalproductData);
            Session()->flash('status', 'Product Additional updated.');

            return response()->json([
                'success' => true,
                'message' => 'Additional Prodcut updated.',
                'data'    => $additionalproduct,
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
