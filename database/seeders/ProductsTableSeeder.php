<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'admin_id' => 1,
                'name' => '抹茶ロールケーキ',
                'stock' => 50,
                'price' => 1200,
                'img_path' => '',
                'comment' => '濃厚な抹茶クリームを使用したロールケーキです。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'admin_id' => 1,
                'name' => '抹茶大福',
                'stock' => 100,
                'price' => 300,
                'img_path' => '',
                'comment' => '大人な味わいが楽しめる大福です。',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
