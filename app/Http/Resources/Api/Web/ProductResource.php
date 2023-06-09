<?php

namespace App\Http\Resources\Api\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'thumbnail' => $this->thumbnail_url,
            'images' => $this->images_url,
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'created_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'category' => $this->whenLoaded('category', new ProductCategoryResource($this->category)),
        ];
    }
}
