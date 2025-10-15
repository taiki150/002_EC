<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class UserController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect();
        $orders = Order::where('user_id', $user->id)->get();

        return view('contents.users.index')->with([
            'cart' => $cart,
            'cartItems' => $cartItems,
            'orders' => $orders,
            'user' => $user,
        ]);
    }

    public function update_show()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        return view('contents.users.update')->with([
            'cart' => $cart,
            'user' => $user,
        ]);
    }

    public function user_update(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        // フォームに入っているものだけ更新
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('email')) {
            $request->validate([
                'email' => 'email|unique:users,email,' . $user->id,
            ]);
            $user->email = $request->email;
        }

        if ($request->filled('address')) {
            $user->address = $request->address;
        }

        $user->save();

        return redirect()->route('products.index', $cart->id)->with('message' , '登録情報を更新しました。');
    }
}
