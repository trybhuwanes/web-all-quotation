<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateKategoriproductRequest;
use App\Models\Category_product;
use Illuminate\Http\Request;
use App\Services\KategoriproductService;


class KategoriproductController extends Controller
{

    public $kategoriproductService;
    
    public function __construct(KategoriproductService $kategoriproductService)
    {
        $this->kategoriproductService = $kategoriproductService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter['search']= $request->q;
        $kategori       = $this->kategoriproductService
                        ->filtering($filter)
                        ->orderBy('created_at', 'asc')
                        ->paginate(10);

        return view('admin.kategori-product.index', compact('kategori'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateKategoriproductRequest $request)
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateKategoriproductRequest $request)
    {
        //
        try {
            $user = $this->kategoriproductService->create($request->all());
            Session()->flash('status', 'Kategori berhasil dibuat.');

            return response()->json([
                'success' => true,
                'message' => 'User successfully created.',
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $kategori = Category_product::findOrFail($id);
            $user = $this->kategoriproductService->update($request->all(), $kategori);
            Session()->flash('status', 'Categori updated.');

            return response()->json([
                'success' => true,
                'message' => 'Categori updated.',
                'data'    => $user,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $kategori = Category_product::findOrFail($id);
            $this->kategoriproductService->destroy($kategori);
            Session()->flash('status', __('notification.delete_success_x', ['x' => __('menu.Kategori Produk')]));

            return response()->json([
                'success' => true,
                'message' => __('notification.delete_success_x', ['x' => __('menu.Kategori Produk')]),
                'data'    => $id,
            ]);
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
        
    }
}
