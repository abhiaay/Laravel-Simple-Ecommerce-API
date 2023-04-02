<?php
namespace App\DTO;

use App\DTO\Base\DTO;
use App\Models\Product;

class CartItem extends DTO
{
    public mixed $cart_id;
    public mixed $product_id;
    public int $qty;

    public function isStockValid(): bool
    {
        return Product::find($this->product_id)->stock >= $this->qty;
    }
}