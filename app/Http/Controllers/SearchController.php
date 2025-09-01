<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(SearchRequest $request)
    {
        $query = $request->input('q');
        $products = [];
 
        if (!empty($query)) {
            $products = Product::where('nama_produk', 'LIKE', '%' . $query . '%')
                            ->orWhere('deskripsi_produk', 'LIKE', '%' . $query . '%')
                            ->orWhere('ringkasan_deskripsi', 'LIKE', '%' . $query . '%')
                            ->get();
        }
        return view('results-search', compact('products', 'query'));
    }
}
