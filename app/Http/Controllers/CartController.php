<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;

class CartController extends Controller
{
    public function index() {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = CartItem::where('cart_id', '=', $cart->id)->get();
        $flg_order_btn_show = true;

        return view('contents.carts.index')->with([
            'cartItems' => $cartItems,
            'cart'      => $cart,
            'flg_order_btn_show' => $flg_order_btn_show,
        ]);
    }
}
