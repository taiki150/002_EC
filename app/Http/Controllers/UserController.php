<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;

class UserController extends Controller
{
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

        return redirect()->route('cart.index', $cart->id);
    }
}
