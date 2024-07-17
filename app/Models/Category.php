<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description']; 

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Accessor for created_at timestamp
    public function getCreatedAtAttribute($value)
    {
        // Format the timestamp to yy/mm/dd
        return date('Y/m/d', strtotime($value));
    }

    // Accessor for updated_at timestamp
    public function getUpdatedAtAttribute($value)
    {
        // Format the timestamp to yy/mm/dd
        return date('Y/m/d', strtotime($value));
    }
}

