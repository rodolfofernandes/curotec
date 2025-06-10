<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Requests\ProductIndexRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(ProductIndexRequest $request)
    {        
        $products = $this->productService->getProducts($request);
        return response()->json($products);
    }
}