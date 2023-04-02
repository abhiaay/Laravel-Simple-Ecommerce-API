<?php
namespace App\Interfaces;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductInterface
{
    /**
     * Create product table
     * @param array $products
     * @param ProductCategory $productCategory
     * 
     * @return Product
     */
    public function createProduct(array $products, ProductCategory $productCategory): Product;

    /**
     * Get product list by paginate
     * @param int $per_page item show per page
     * @param array $request additional
     * 
     * @return LengthAwarePaginator
     */
    public function getPaginate(int $per_page = 10): LengthAwarePaginator;
}