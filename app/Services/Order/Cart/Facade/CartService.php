<?php
namespace App\Services\Order\Cart\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse login(array $credentials) login
 */
class CartService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return \App\Services\Order\Cart\CartService::class; }
}