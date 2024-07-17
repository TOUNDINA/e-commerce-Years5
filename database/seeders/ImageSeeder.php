<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all product IDs from the products table
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Check if there are any products available
        if (!empty($productIds)) {
            // Generate a random product_id from the available product IDs
            $productId = $productIds[array_rand($productIds)];

            // Insert the image data with the generated product_id
            DB::table('images')->insert([
                'images' => '', // Your image data
                'created_at' => now(),
                'updated_at' => now(),
                'product_id' => $productId
            ]);
        } else {
            // If there are no products available, insert with a default product_id
            DB::table('images')->insert([
                'images' => '', // Your image data
                'created_at' => now(),
                'updated_at' => now(),
                'product_id' => 1 // Default product_id
            ]);
        }
    }
}