<?php

namespace App\Http\Services;

use App\Http\Filters\ProductFilter;
use App\Models\Product;

class ProductService
{
    public function index($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 40;

        $filter = app(ProductFilter::class, ['queryParams' => $data]);

        return Product::filter($filter)->paginate($perPage, ['*'], 'page', $page);
    }

}
