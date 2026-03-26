<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class CartItemController extends Controller
{
    // カートアイテム追加（新規）
    public function createItem_create(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = new CartItem();
        $product = Product::where('id', $request->product_id)->first();
        
        DB::beginTransaction();

        try {
            $cartItem->createItem_create($product, $cart);
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('products.index')->with('message', 'カート追加に失敗しました。');
        }
        DB::commit();

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $count = count($cartItems);

        return response()->json([
            'count' => $count
        ]);
    }

    // カートアイテム追加（更新）
    public function createItem_create_add(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $request->product_id)->first();
        DB::beginTransaction();

        try {
            $cartItem->item_quantity = $cartItem->item_quantity + 1;
            $cartItem->unit_price = $cartItem->product->price * $cartItem->item_quantity;
            $cartItem->save();
        } catch (\Throwable $e) {
            return redirect()->route('products.index')->with('message', 'カート追加に失敗しました。');
        }

        DB::commit();

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total = $total + ($item->product->price * $item->item_quantity);
        }

        return response()->json([
            'cartItem' => $cartItem,
            'total' => $total,
        ]);
    }

    // カートアイテム削除（1個）
    public function createItem_create_remove(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $request->product_id)->first();
        DB::beginTransaction();

        try {
            $cartItem->item_quantity = $cartItem->item_quantity - 1;
            $cartItem->unit_price = $cartItem->unit_price - $cartItem->product->price;
            $cartItem->save();
        } catch (\Throwable $e) {
            return redirect()->route('products.index')->with('message', 'カート追加に失敗しました。');
        }

        DB::commit();

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total = $total + ($item->product->price * $item->item_quantity);
        }

        return response()->json([
            'cartItem' => $cartItem,
            'total' => $total,
        ]);
    }

    // カートアイテムの削除
    public function createItem_delete(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = cartItem::where('cart_id', $cart->id)->where('product_id', $request->product_id)->first();

        $cartItem->delete();

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total = $total + ($item->product->price * $item->item_quantity);
        }

        return response()->json([
            'product_id' => $request->product_id,
            'cartItem' => $cartItem,
            'total' => $total,
        ]);
    }
}
