<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 公開ページ
Route::get('/', function () {
    return view('welcome');
});

// Google Login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// LINE Login
Route::get('auth/line', [LineController::class, 'redirectToLine'])->name('line.login');
Route::get('auth/line/callback', [LineController::class, 'handleLineCallback']);

// 決済成功後に戻る
Route::get('/checkout/success', [App\Http\Controllers\OrderController::class, 'success'])->name('checkout.success');

// 決済キャンセル時
Route::get('/checkout/cancel', [App\Http\Controllers\CartController::class, 'index'])->name('checkout.cancel');

// Webhook (Stripe → サーバーへ通知)
Route::post('/stripe/webhook', [App\Http\Controllers\StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');


Auth::routes();

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ユーザー画面
    Route::get('user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('user/update/show', [UserController::class, 'update_show'])->name('user.update.show');
    Route::get('/user/{id}', [UserController::class, 'userShow'])->name('user.show');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/cart/{id}', [CartController::class, 'index'])->name('cart.index');
    Route::post('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('order', [OrderController::class, 'store'])->name('order.store');
    Route::post('user/update', [UserController::class, 'user_update'])->name('user.update');

    // カート操作
    Route::post('/cartItem/create', [CartItemController::class, 'createItem_create'])->name('cart.item.create');
    Route::post('/cartItem/create/add', [CartItemController::class, 'createItem_create_add'])->name('cart.item.create.add');
    Route::post('/cartItem/create/remove', [CartItemController::class, 'createItem_create_remove'])->name('cart.item.create.remove');
    Route::post('/cartItem/delete', [CartItemController::class, 'createItem_delete'])->name('cart.item.delete');
});
