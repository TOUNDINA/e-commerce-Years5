<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this import statement
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            //'name' => Str::random(10)
            'name'=>'ABC',
            'description'=>'for man',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);
    }
}
