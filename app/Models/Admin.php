<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'gender',
        'date_of_birth',
        'address',
    ];

    protected $hidden = [
        'password', // Ensure password is hidden in JSON responses
        'remember_token', // Hide the remember token
    ];

    protected $casts = [
        'date_of_birth' => 'date', // Cast date_of_birth to date format
    ];
}
