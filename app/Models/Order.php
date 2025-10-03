<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_id',
        'order_number',
        'total_cache',
    ];

    public function store($request, $user_id, $total) {
        // order_number設定
        $lastOrder = Order::latest('id')->first();
        $last_order_id = Order::all()->last()->id;
        $lastId = $lastOrder ? $lastOrder->id : 0;

        $number = $lastId + 1;
        $order_number = 'ORD_' . str_pad($number, 6, '0', STR_PAD_LEFT);

        DB::table('orders')->insert([
            'user_id' => $user_id,
            'cart_id' => $request->cart_id,
            'order_number' => $order_number,
            'total_cache' => $total,
        ]);

    }
}
