<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function store($request, $user_id) {
        DB::table('orders')->insert([
            'user_id' => $user_id,
            'cart_item_id' => $request->cart_item_id,
            'order_number' => $request->order_number,
            'total_cache' => $request->total_cache,
        ]);
    }
}
