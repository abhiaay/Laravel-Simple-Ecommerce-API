<?php

namespace App\Http\Resources\Api\Web;

use App\Services\Order\Cart\Facade\CartService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'qty' => $this->qty,
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'created_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'total' => CartService::calculateSubTotalPerItem($this->resource),
            'product' => [
                'id' => $this->product->id,
                'slug' => $this->product->slug,
                'name' => $this->product->name,
                'stock' => $this->product->stock,
                'price' => $this->product->price,
                'category' => [
                    'name' => $this->product->category->name,
                    'slug' => $this->product->category->slug,
                ]
            ]
        ];
    }
}
