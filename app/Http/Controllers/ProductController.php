<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    public $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $products = $this->service->index($data);

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
