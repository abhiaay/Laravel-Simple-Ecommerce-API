<?php
namespace App\Interfaces;

use App\DTO\Cart as DTOCart;
use App\DTO\CartItem as DTOCartItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;

interface CartInterface
{
    /**
     * Add item to the cart
     */
    public function addItem(Cart $cart, DTOCartItem $DTOCartItem): CartItem;

    /**
     * Create cart
     */
    public function createCart(DTOCart $DTOCart): Cart;

    /**
     * Delete cart
     */
    public function deleteCart(): void;
}