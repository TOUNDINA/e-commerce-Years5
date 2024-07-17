<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Order_productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders_product')->insert([
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pexels.com%2Fsearch%2Fbeautiful%2F&psig=AOvVaw01efP1bJFMeA4_ReMA5kBc&ust=1705636758078000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCMCV75uG5oMDFQAAAAAdAAAAABAD',
            'product_id'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
