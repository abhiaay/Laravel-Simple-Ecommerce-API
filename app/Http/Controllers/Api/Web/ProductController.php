<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Web\ProductCollection;
use App\Http\Resources\Api\Web\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductCollection::make(Product::filter(request()->all())->paginate(10)->withQueryString());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
