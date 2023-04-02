<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\ProductRequest;
use App\Http\Resources\Api\Web\ProductCollection;
use App\Http\Resources\Api\Web\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $per_page = request('per_page', 10);

        return $this->productService->getPaginate($per_page);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        return $this->productService->store($request);
    }
}
