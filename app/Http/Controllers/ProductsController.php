<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category_product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{

    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display all product listing of the resource.
     */
    public function index(Request $request)
    {
        $filters['search'] = $request->q;
        $filters['scope'] = $request->input('filter_scope', []);

        $query = $filters['search'];
        $scopes = Category_product::all();
        $products = $this->productService->filtering($filters)->paginate(12);
        return view('products', compact('scopes', 'products', 'query'));
    }

    /**
     * Display a listing of the resource.
     */
    public function detail(string $slug)
    {
        //
        $productShow = $this->productService->findBySlug($slug);

        // Periksa spesifikasi mana yang tidak null
        if ($productShow->specificationFas->isNotEmpty()) {
            $productType = $productShow->specificationFas;
        } elseif ($productShow->specificationFmp->isNotEmpty()) {
            $productType = $productShow->specificationFmp;
        } else {
            $productType = null;
        }
        return view('products-detail', compact('productShow', 'productType'));
    }

    public function project(string $slug)
    {
        $productShow = $this->productService->findBySlug($slug);

        $productShow->load(['projects.media']); // load project + media

        if ($productShow->specificationFas->isNotEmpty()) {
            $productType = $productShow->specificationFas;
        } elseif ($productShow->specificationFmp->isNotEmpty()) {
            $productType = $productShow->specificationFmp;
        } else {
            $productType = null;
        }

        return view('products-project', compact('productShow', 'productType'));
    }

    /**
     * Display a listing of the resource.
     */
    public function specification(string $slug)
    {
        // 
        $productShow = $this->productService->findBySlug($slug);

        // Periksa spesifikasi mana yang tidak null
        if ($productShow->specificationFas->isNotEmpty()) {
            $productType = $productShow->specificationFas;
        } elseif ($productShow->specificationFmp->isNotEmpty()) {
            $productType = $productShow->specificationFmp;
        } else {
            $productType = null;
        }
        return view('products-specification', compact('productShow', 'productType'));
    }

    public function downloadBrosur(string $slug)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return Redirect::route('login')->with('error', 'Anda harus login untuk mendownload brosur.');
        }


        $productFind = $this->productService->findBySlug($slug);
        if ($productFind->slug === "flowrex-surface-aerator") {
            $file = public_path('brosur/flowrex-surface-aerator-brosur.pdf');
        } elseif ($productFind->slug === "flowrex-multi-plate-screw-press") {
            $file = public_path('brosur/flowrex-multi-plate-screw-press-brosur.pdf');
        } else {
            $file = null;
        }

        // Download file brosur
        return Response::download($file);
    }


    /**
     * Display all product listing of the resource.
     */
    public function  industry($industry)
    {
        $validIndustries = ['mining', 'foodandbeverange', 'agroindustry', 'palmoil', 'textile', 'hospitality'];

        if (in_array($industry, $validIndustries)) {
            return view("industries.$industry");
        }

        abort(404, 'Industry not found');
    }
}
