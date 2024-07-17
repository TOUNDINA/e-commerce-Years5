<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Make sure to hash the password
            'phone_number' => '087241229',
            'gender' => 'Male',
            'date_of_birth' => '1990-01-01',
            'address' => '#001, St192 , sangkat teuk la’ork 3 , khan Toul kork , Phnom Penh, Cambodia',
            
        ]);
    }
}
