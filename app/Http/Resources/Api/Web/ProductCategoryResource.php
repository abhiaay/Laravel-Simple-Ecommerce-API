<?php

namespace App\Http\Resources\Api\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
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
            'slug' => $this->slug,
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'created_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
        ];
    }
}
