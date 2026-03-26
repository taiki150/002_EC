<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'id'              => 1,
                'user_id'         => 1, // usersテーブルのid
                'admin_id'        => 1, // adminsテーブルのid
                'product_id'      => 1, // productsテーブルのid
                'review_contents' => '抹茶ロールケーキはとても美味しくて、また買いたいと思いました！',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id'              => 2,
                'user_id'         => 1,
                'admin_id'        => 1,
                'product_id'      => 2,
                'review_contents' => 'いちご大福のいちごが新鮮で甘く、餅との相性も最高でした。',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
        ]);
    }
}
