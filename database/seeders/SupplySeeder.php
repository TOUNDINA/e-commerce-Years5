<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this import statement

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            'name' => 'ABC',
            'address' => 'Phnom penh',
            'phone' => '093211233',
            'email' => 'sopharongtha13@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
