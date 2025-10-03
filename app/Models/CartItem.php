<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'unit_price',
        'item_quantity',
    ];

    // カートアイテムはカートに属する
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // カートアイテムは商品に属する
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // カート内へ商品追加
    public function createItem_create($product, $cart)
    {
        DB::table('cart_items')->insert([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'unit_price' => $product->price,
            'item_quantity' => 1
        ]);

    }
}
