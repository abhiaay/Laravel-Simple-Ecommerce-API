<?php

namespace App\Http\Resources\Api\Web;

use App\Services\Order\Cart\Facade\CartService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'total' => CartService::calculateTotal($this->resource),
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'created_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
            'items' => $this->whenLoaded('items', CartItemCollection::make($this->items))
        ];
    }
}
