<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use App\Services\KategoriproductService;
use App\Services\ProductService;
use App\Services\UserService;

class Select2Controller extends Controller
{
    //
    public function __construct(
        public KategoriproductService $kategoriproductService,
        public ProductService $productService,
        public UserService $userService,
    ) {
    }

    public function itemCategory(Request $request)
    {
        if ($request->wantsJson()) {
            $term    = trim($request->q);
            $filters = $request->filters ?? [];
            $query   = $this->kategoriproductService->select2($filters);

            if (empty($term)) {
                $kategoriProduct = $query->get();
            } else {
                $kategoriProduct = $query->where('nama_kategori', 'like', '%' . $term . '%')->get();
            }

            return Response::json($kategoriProduct);
        }
    }

    public function itemProductmain(Request $request)
    {
        if ($request->wantsJson()) {
            $term    = trim($request->q);
            $filters = $request->filters ?? [];
            $query   = $this->productService->select2($filters);

            if (empty($term)) {
                $productMain = $query->get();
            } else {
                $productMain = $query->where('nama_produk', 'like', '%' . $term . '%')->get();
            }

            return Response::json($productMain);
        }
    }

    public function userPic(Request $request)
    {
        if ($request->wantsJson()) {
            $term    = trim($request->q);
            $filters = $request->filters ?? [];
            $query   = $this->userService->select2pic($filters);

            if (empty($term)) {
                $pic = $query->get();
            } else {
                $pic = $query->where('name', 'like', '%' . $term . '%')->get();
            }

            return Response::json($pic);
        }
    }
}
