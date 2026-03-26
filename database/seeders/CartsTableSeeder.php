<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'id'          => 1,
                'user_id'     => 1,  // UsersテーブルのIDと紐づけ
                'status_id'   => 1,  // Statusesテーブル（例: 未購入、購入済み等）のID
                'total_cache' => 1500,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'id'          => 2,
                'user_id'     => 2,
                'status_id'   => 1,
                'total_cache' => 3000,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
