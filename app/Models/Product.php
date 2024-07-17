<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pricing', 'discount','color','category_id','image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);  // if we want to find that product belong to which category 
    }
    public function images(){
        return $this->hasMany(Image::class,'product_id','id');
    }

    // add new code 
    public function firstImage()
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }


    // Add this method to format dates
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
