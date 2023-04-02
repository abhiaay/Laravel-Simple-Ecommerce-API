<?php
namespace App\Repositories\MongoDB;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\ProductInterface;
use App\Models\ProductCategory;

class ProductRepository implements ProductInterface
{
    public function createProduct(array $products, ProductCategory $productCategory): Product
    {
        return $productCategory->products()->create($products);
    }

    public function getPaginate($per_page = 10): LengthAwarePaginator
    {
        return Product::paginate($per_page)->withQueryString();
    }
}