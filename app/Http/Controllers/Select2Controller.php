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
use App\Models\Additional_product;
use App\Models\Company;
use App\Models\User;

class Select2Controller extends Controller
{
    //
    public function __construct(
        public KategoriproductService $kategoriproductService,
        public ProductService $productService,
        public UserService $userService,
    ) {}

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

    public function itemProductAdditional(Request $request, $mainProductId)
    {
        $query = Additional_product::where('product_id', $mainProductId);

        if ($request->has('q')) {
            $search = $request->get('q');
            $query->where('nama_produk_tambahan', 'like', "%{$search}%");
        }

        $results = $query->limit(10)->get()->map(function ($item) {
            return [
                'id'   => $item->id,
                'text' => $item->nama_produk_tambahan,
                'harga' => $item->harga_produk_tambahan,
            ];
        });

        return response()->json($results);
    }


    public function client(Request $request)
    {
        $search = $request->q;

        $query = User::where('role', 'customer');

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('company', 'like', "%$search%");
        }

        $customers = $query->limit(20)->get();

        return response()->json(
            $customers->map(fn($c) => [
                'id' => $c->id,
                'text' => "{$c->name} - {$c->company}",
            ])
        );
    }

    public function showClient($id)
    {
        $client = User::where('role', 'customer')->findOrFail($id);

        return response()->json([
            'id'       => $client->id,
            'name'     => $client->name,
            'email'    => $client->email,
            'company'  => $client->company,
            'location_company'  => $client->location_company,
            'phone'    => $client->phone,
        ]);
    }

    public function company(Request $request)
    {
        $search = $request->q;

        $query = Company::query();

        if ($search) {
            $query->where('company', 'like', "%$search%");
        }

        $company = $query->limit(20)->get();

        return response()->json(
            $company->map(fn($c) => [
                'id' => $c->id,
                'text' => "{$c->company}",
            ])
        );
    }


    public function showCompany($id)
    {
        $company = Company::findOrFail($id);

        return response()->json([
            'id'       => $company->id,
            'company'     => $company->company,
            'email'    => $company->email,
            'phone'  => $company->phone,
            'address'  => $company->address,
        ]);
    }

}
