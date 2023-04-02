<?php
namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ProductCategoryInterface
{

    /**
     * Get product category list by paginate
     * @param int $per_page item show per page
     * 
     * @return LengthAwarePaginator
     */
    public function getPaginate(int $per_page = 10): LengthAwarePaginator;
}