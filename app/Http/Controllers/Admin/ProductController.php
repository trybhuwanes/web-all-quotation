<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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

        // dd($products);
        return view('admin.product.index', compact('products'));
        // return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.product.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        //
        // dd($request->all());
        Log::info('DEBUG REQUEST DATA', $request->all());
        try {
            $user = $this->productService->create($request->all());
            Session()->flash('status', 'Product berhasil dibuat.');

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
        $product = Product::where('uuid', $id)->with(['categoryProducts', 'specificationFas', 'specificationFmp'])->first();

        $product = $this->productService->findByUuid($id);
        if ($product->specificationFas->isNotEmpty()) {
            $productType = $product->specificationFas;
        } elseif ($product->specificationFmp->isNotEmpty()) {
            $productType = $product->specificationFmp;
        } else {
            $productType = null; // Jika keduanya null
        }
        // dd($product->specificationFas);
        return view('admin.product.detail_product', compact('product', 'productType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::where('uuid', $id)->first();
        return view('admin.product.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->all());
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // 
    public function storageDropzoneImg(Request $request)
    {
        $path = storage_path('app/public/img/produk/tmp/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
