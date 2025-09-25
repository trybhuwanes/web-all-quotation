<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_specification_fas;
use App\Models\Product_specification_fmp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProducttypepicController extends Controller
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
    public function edit(string $productId, string $typeId)
    {
        //
        $productFind = Product::where('uuid', $productId)->first();

        // Daftar spesifikasi yang tersedia
        $specificationTypes = [
            'specificationFas',
            'specificationFmp',
            'specificationBg',
            'specificationBf',
            'specificationDiac',
            'specificationSag',
            'specificationPcx'
        ];

        // Loop melalui spesifikasi dan cari berdasarkan typeId
        $productTypeField = null;
        foreach ($specificationTypes as $type) {
            if ($productFind->$type->isNotEmpty()) {
                $productTypeField = $productFind->$type->where('id', $typeId)->first();
                if ($productTypeField) {
                    break;
                }
            }
        }

        // Jika productTypeField ditemukan, ambil nama kolom spesifikasinya
        if ($productTypeField) {
            $columns = Schema::getColumnListing($productTypeField->getTable());

            // Hapus kolom yang tidak perlu seperti id, product_id, created_at, updated_at
            $spesificationColumnsField = array_diff($columns, ['id', 'product_id', 'harga', 'type_name', 'created_at', 'updated_at']);

            $fieldTypes = [];
            foreach ($spesificationColumnsField as $field) {
                $fieldTypes[$field] = DB::getSchemaBuilder()->getColumnType($productTypeField->getTable(), $field);
            }

            // dd($spesificationColumnsField);

            return view('pic.product-type.edit_product', compact('productFind', 'productTypeField', 'spesificationColumnsField', 'fieldTypes'));
        } else {
            // Jika tidak ada spesifikasi ditemukan
            return back()->with('error', 'Spesifikasi produk tidak ditemukan.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $productId, string $typeId)
    {
        //
        // dd($request->all());
        try {
            $productFind = Product::where('uuid', $productId)->first();

            // Daftar tipe spesifikasi yang terkait dengan modelnya
            $specificationMappings = [
                'specificationFas' => Product_specification_fas::class,
                'specificationFmp' => Product_specification_fmp::class,
                // 'specificationBg' => Product_specification_bg::class,
                // 'specificationBf' => Product_specification_bf::class,
                // 'specificationDiac' => Product_specification_diac::class,
                // 'specificationSag' => Product_specification_sag::class,
                // 'specificationPcx' => Product_specification_pcx::class,
            ];

            // Loop untuk menemukan spesifikasi yang ada
            $specification = null;
            foreach ($specificationMappings as $specificationType => $modelClass) {
                if ($productFind->$specificationType->isNotEmpty()) {
                    $specification = $productFind->$specificationType->where('id', $typeId)->first();
                    if ($specification) {
                        break;
                    }
                }
            }

            if ($specification) {
                $specification->update($request->all());
                return redirect()->route('picproduct.index')->with('success', 'Tipe Produk Berhasil diperbarui!');
            } else {
                return back()->with('error', 'Spesifikasi produk tidak ditemukan.');
            }
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
