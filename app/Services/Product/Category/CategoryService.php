<?php
namespace App\Services\Product\Category;

use App\Http\Resources\Api\Web\ProductCategoryCollection;
use App\Http\Resources\Api\Web\ProductCollection;
use App\Repositories\MongoDB\ProductCategoryRepository;
use App\Traits\ResponseAPI;

class CategoryService
{
    use ResponseAPI;

    protected ProductCategoryRepository $productRepository;

    public function __construct(ProductCategoryRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getPaginate(int $per_page = 10): ProductCategoryCollection
    {
        return ProductCategoryCollection::make($this->productRepository->getPaginate($per_page));
    }

}