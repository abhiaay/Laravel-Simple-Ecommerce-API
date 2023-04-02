<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'AuthController@doLogin')->name('login');
});
Route::apiResource('product/category', 'ProductCategoryController')->only('index');
Route::apiResource('product', 'ProductController')->only(['index', 'show', 'store']);
Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
    Route::post('add-item', 'CartController@addItem')->name('add-item');
    Route::get('my-cart', 'CartController@show')->name('show');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
