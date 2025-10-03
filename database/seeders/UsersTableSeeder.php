<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'             => 1,
                'name'           => '松岡泰生',
                'address'        => '山口県○○市△△町', // ← addressは例、必要に応じて変更
                'birth_day'      => '1999-07-11',
                'email'          => 'taiki1544.0711@gmail.com',
                'password'       => '$2y$12$7ERAYgD1T0rG6vGSKRC02.MOnVcJtJP0eTZllgQBDeG...', // ハッシュ済みパスワード
                'remember_token' => Str::random(60),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'id'             => 2,
                'name'           => '松岡麻菜',
                'address'        => '山口県○○市△△町', // ← addressは例、必要に応じて変更
                'birth_day'      => '1998-09-13',
                'email'          => 'mana@gmail.com',
                'password'       => '$2y$12$7ERAYgD1T0rG6vGSKRC02.MOnVcJtJP0eTZllgQBDeG...', // ハッシュ済みパスワード
                'remember_token' => Str::random(60),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]
        ]);
    }
}
