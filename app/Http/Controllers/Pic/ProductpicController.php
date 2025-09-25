<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;

class ProductpicController extends Controller
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter['search'] = $request->q;
        $products       = $this->productService
            ->filtering($filter)
            ->with('categoryProducts')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        return view('pic.product.index', compact('products'));
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
        $product = Product::where('uuid', $id)->with(['categoryProducts', 'specificationFas', 'specificationFmp'])->first();

        $product = $this->productService->findByUuid($id);
        if ($product->specificationFas->isNotEmpty()) {
            $productType = $product->specificationFas;
        } elseif ($product->specificationFmp->isNotEmpty()) {
            $productType = $product->specificationFmp;
        } else {
            $productType = null;
        }
        return view('pic.product.detail_product', compact('product', 'productType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::where('uuid', $id)->first();
        return view('pic.product.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $productData = Product::findOrFail($request->id);
            $product = $this->productService->update($request->all(), $productData);
            Session()->flash('status', 'Product updated.');

            return response()->json([
                'success' => true,
                'message' => 'Prodcut updated.',
                'data'    => $product,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
