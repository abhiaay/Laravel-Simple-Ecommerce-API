<?php
namespace App\Services\Product;

use App\Http\Requests\Api\Web\ProductRequest;
use App\Http\Resources\Api\Web\ProductCollection;
use App\Http\Resources\Api\Web\ProductResource;
use App\Models\ProductCategory;
use App\Repositories\MongoDB\ProductRepository;
use App\Services\Image\ImageUpload\ImageUploadService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Response;
use Throwable;

class ProductService
{
    use ResponseAPI;

    private string $folderName =  'products';
    protected ProductRepository $productRepository;
    protected ImageUploadService $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService)
    {
        $this->productRepository = $productRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function getPaginate(int $per_page = 10): ProductCollection
    {
        return ProductCollection::make($this->productRepository->getPaginate($per_page));
    }

    public function store(ProductRequest $productRequest): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $productRequest->safe()->except(['thumbnail', 'images', 'category_id']);

            if($productRequest->hasFile('thumbnail')) {
                $thumbnail = $this->imageUploadService->store($productRequest->file('thumbnail'), $this->folderName, 'public', 'thumb');
                $data = array_merge($data, ['thumbnail' => $thumbnail]);
            }
            
            if($productRequest->hasFile('images')) {
                $images = [];
                foreach($productRequest->file('images') as $image) {
                    $images[] = $this->imageUploadService->store($image, $this->folderName, 'public');
                }
                $data = array_merge($data, ['images' => $images]);
            }

            $productCategory = ProductCategory::find($productRequest->category_id);

            if($product = $this->productRepository->createProduct($data, $productCategory)) {
                return $this->success('Successful Create Product', new ProductResource($product), Response::HTTP_CREATED);
            } else {
                return $this->error('Failed to create product, something have wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } catch(Throwable $e) {
            // delete thumbnail if failed to save
            if(isset($thumbnail)) {
                $this->imageUploadService->delete($thumbnail, 'public');
            }

             // delete images if failed to save
            if(isset($images)) {
                foreach($images as $image) {
                    $this->imageUploadService->delete($image, 'public');
                }
            }

            throw $e;
        }
    }
}