<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id'           => 1,
                'user_id'      => 1,   // usersテーブルのid
                'cart_id' => 1,   // cartテーブルのid
                'order_number' => 'ORD_01',
                'total_cache'  => 2400, // 例: 抹茶ロールケーキ1200 × 2
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id'           => 2,
                'user_id'      => 1,
                'cart_id' => 2,
                'order_number' => 'ORD_01',
                'total_cache'  => 900, // 例: いちご大福300 × 3
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
