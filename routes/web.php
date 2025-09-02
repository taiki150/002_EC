<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ★ユーザー画面★
// 画面遷移(GET)

// ユーザー情報確認画面
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'userShow'])->name('user.show');

// Top画面(商品一覧)
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

// カート内画面
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

// 購入画面 id=cartItemのid
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');

// 機能(POST)


// ★管理画面★
// 画面遷移(GET)
// 機能(POST)
