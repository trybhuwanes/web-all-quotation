<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AdditionalproductService;
use App\Http\Requests\CreateAdditionalproductRequest;
use App\Models\Additional_product;
use App\Models\Product;

class AdditionalproductController extends Controller
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
        $produk = $request->prod;
        $filter['search']= $request->q;
        $additionalproducts       = $this->additionalproductService
                                    ->filtering($filter)
                                    ->with('product')
                                    ->when($produk, function ($query, $produk) {
                                        $query->where('product_id', $produk);
                                    })
                                    ->orderBy('created_at', 'asc')
                                    ->paginate(10);

        $prod = Product::select('id', 'nama_produk')
                ->orderBy('nama_produk')
                ->get();
        return view('admin.product-additional.index', compact('additionalproducts', 'prod'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.product-additional.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdditionalproductRequest $request)
    {
        //
        // dd($request->all());
        try {
            $user = $this->additionalproductService->create($request->all());
            Session()->flash('status', 'Additional Product berhasil dibuat.');

            return response()->json([
                'success' => true,
                'message' => 'Product successfully created.',
                'data'    => $user,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
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
        $additionalproducts = Additional_product::where('uuid', $id)->first();
        return view('admin.product-additional.edit_product', compact('additionalproducts'));
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
        try {
            $additionalproduct = Additional_product::findOrFail($id);
            $this->additionalproductService->destroy($additionalproduct);
            Session()->flash('status', __('notification.delete_success_x', ['x' => __('menu.Produk')]));

            return response()->json([
                'success' => true,
                'message' => __('notification.delete_success_x', ['x' => __('menu.Produk')]),
                'data'    => $id,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }
}
