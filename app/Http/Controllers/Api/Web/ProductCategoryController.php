<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Services\Product\Category\CategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected CategoryService $productCategoryService;

    public function __construct(CategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;  
    }
    
    public function index()
    {
        $per_page = request('per_page', 10);

        return $this->productCategoryService->getPaginate($per_page);
    }
}
