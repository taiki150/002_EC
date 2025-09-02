<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\CartItem;

class OrderController extends Controller
{
    public function index() {
        return view('contents.orders.index');
    }

    public function store(Request $id , $request) {
        $cartItem = CartItem::find($id);

        $order = new Order();
        
        DB::beginTransaction();
        $user_id = User::auth()->id;

        try {
            $order->store($request, $user_id);

        } catch (\Exception $e) {
                DB::rollBack();
            return redirect()->route('carta.index')->with('message', '購入処理に失敗しました。');
        }
    }
}
