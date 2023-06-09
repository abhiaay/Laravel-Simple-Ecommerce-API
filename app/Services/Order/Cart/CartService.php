<?php
namespace App\Services\Order\Cart;

use App\Models\Cart;
use App\Models\User;
use App\Traits\ResponseAPI;
use App\DTO\Cart as DTOCart;
use App\DTO\CartItem as DTOCartItem;
use App\Exceptions\CartException;
use App\Models\CartItem;
use App\Models\Product;
use App\Repositories\MongoDB\CartRepository;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    use ResponseAPI;

    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Add single item to cart
     */
    public function addItem(Cart $cart, array $item): CartItem|bool
    {
        $DTOCartItem = new DTOCartItem(array_merge($item, ['cart_id' => $cart->id]));
        if(! $DTOCartItem->isStockValid()) {
            throw new CartException("Failed add cart, stock exceed");
        }
        
        if($this->hasProduct($cart, Product::find($DTOCartItem->product_id))) {
            throw new CartException("Item already in cart");
        }

        return $this->cartRepository->addItem($cart, $DTOCartItem) ?? false;
    }

    /**
     * Add collection of items to given cart
     */
    public function addItems(Cart $cart, array $items): bool
    {
        foreach($items as $item) {
            if(! $this->addItem($cart, $item)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if cart has product
     */
    public function hasProduct(Cart $cart, Product $product): bool
    {
        return $cart->items()->where('product_id', $product->id)->get()->first() ? true : false;
    }

    /**
     * Create Cart
     */
    public function createCart(User $user): Cart|false
    {
        $DTOCart = new DTOCart(['user_id' => $user->id]);

        if($cart = $this->cartRepository->createCart($DTOCart)) {
            return $cart;
        }
        return false;
    }

    /**
     * Calculate sub total of cart item
     */
    public function calculateSubTotalPerItem(CartItem $cartItem): float
    {
        return $cartItem->qty * $cartItem->product->price;
    }

    /**
     * Calculate total price per cart
     */
    public function calculateTotal(Cart $cart): float
    {
        $total = 0;
        foreach($cart->items as $item) {
            $total += $this->calculateSubTotalPerItem($item);
        }

        return $total;
    }
}