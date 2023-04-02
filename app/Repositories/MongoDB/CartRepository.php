<?php
namespace App\Repositories\MongoDB;

use App\DTO\Cart as DTOCart;
use App\DTO\CartItem as DTOCartItem;
use App\Interfaces\CartInterface;
use App\Models\Cart;
use App\Models\CartItem;

class CartRepository implements CartInterface
{
    public function addItem(Cart $cart, DTOCartItem $DTOCartItem): CartItem
    {
        return CartItem::create($DTOCartItem->toArray());
    }

    public function createCart(DTOCart $DTOCart): Cart
    {
        return Cart::create($DTOCart->toArray());
    }

    public function deleteCart(): void
    {
        
    }
}