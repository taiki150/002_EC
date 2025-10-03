<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $user = auth()->user();
        $user_id = $user->id;
        $cart = Cart::where('user_id', $user_id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        
        return view('contents.products.index')->with([
            'products' => $products,
            'cart' => $cart,
            'cartItems' => $cartItems,
        ]);
    }
}
