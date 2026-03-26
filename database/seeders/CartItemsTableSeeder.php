<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cart_items')->insert([
            [
                'id'            => 1,
                'cart_id'       => 1,   // cartsテーブルのID
                'product_id'    => 1,   // productsテーブルのID
                'unit_price'    => 1200,
                'item_quantity' => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 2,
                'cart_id'       => 1,
                'product_id'    => 2,
                'unit_price'    => 300,
                'item_quantity' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 3,
                'cart_id'       => 2,
                'product_id'    => 1,
                'unit_price'    => 1200,
                'item_quantity' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
