<?php
namespace App\Services\Order\Cart;

use App\Models\Cart;
use App\Models\User;
use App\Traits\ResponseAPI;
use App\DTO\Cart as DTOCart;
use App\DTO\CartItem as DTOCartItem;
use App\Exceptions\CartException;
use App\Models\CartItem;
use App\Repositories\MongoDB\CartRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CartService
{
    use ResponseAPI;

    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addItem(Cart $cart, array $item): CartItem|bool
    {
        $DTOCartItem = new DTOCartItem(array_merge($item, ['cart_id' => $cart->id]));
        if(! $DTOCartItem->isStockValid()) {
            throw new CartException("Failed add cart, stock exceed");
        }
        return $this->cartRepository->addItem($cart, $DTOCartItem) ?? false;
    }

    public function addItems(Cart $cart, array $items): bool
    {
        foreach($items as $item) {
            if(! $this->addItem($cart, $item)) {
                return false;
            }
        }
        return true;
    }

    public function createCart(User $user): Cart|false
    {
        $DTOCart = new DTOCart(['user_id' => $user->id]);

        if($cart = $this->cartRepository->createCart($DTOCart)) {
            return $cart;
        }
        return false;
    }
}