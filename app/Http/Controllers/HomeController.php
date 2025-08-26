<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class HomeController extends Controller
{
    public $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = $this->productService->model()
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
        return view('index', compact('products'));

        // return view('index');
    }
}
