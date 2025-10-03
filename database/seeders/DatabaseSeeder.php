<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        $this->call([
            AdminsTableSeeder::class,
            CategoriesTableSeeder::class,
            StatusesTableSeeder::class,   // ← carts より前にする！
            ProductsTableSeeder::class,
            UsersTableSeeder::class,
            CartsTableSeeder::class,
            CartItemsTableSeeder::class,
            ReviewsTableSeeder::class,
            OrdersTableSeeder::class,
        ]);
    }



}
