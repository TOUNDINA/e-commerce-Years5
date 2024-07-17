<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this import statement
use Illuminate\Support\Str;
use Carbon\Carbon; // Add this import statement

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Use the DB facade to insert data
          DB::table('products')->insert([
            'name' => 'Product 1',
            'pricing' => 19.99,
            'discount' => 5.00,
            'p' => 'Tag1,Tag2',
            'promotion_date' => now(),
            'color' => 'Red',
            'rating' => 4,
            'purchased_num' => 100,
            'size' => 'Medium',
            'brand' => 'Brand A',
            'style' => 'Style1',
            'model' => 'Model123',
            'shipping' => 'Free',
            'category_id' => 1, // Replace with the actual category ID
            'supplier_id' => 1, // Replace with the actual supplier ID
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => Carbon::now()->format('Y-m-d'),
        ]);


    }
}
