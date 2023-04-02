<?php

namespace App\Http\Controllers\Api\Web;

use App\DTO\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\AddCartItemRequest;
use App\Http\Resources\Api\Web\CartItemResource;
use App\Services\Order\Cart\CartService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    use ResponseAPI;

    protected CartService $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;    
    }

    public function addItem(AddCartItemRequest $request): \Illuminate\Http\JsonResponse
    {
        $cart = $request->user()->cart ?? $this->cartService->createCart($request->user());
        if($cartItem = $this->cartService->addItem($cart, $request->validated())) {
            return $this->success('Successful Add Item to Cart', new CartItemResource($cartItem));
        }
        
        return $this->error('Failed to add item to cart, something happen', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
