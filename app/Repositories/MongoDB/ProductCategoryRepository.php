<?php
namespace App\Repositories\MongoDB;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductCategoryRepository implements ProductCategoryInterface
{
    public function getPaginate($per_page = 10): LengthAwarePaginator
    {
        return ProductCategory::paginate($per_page)->withQueryString();
    }
}