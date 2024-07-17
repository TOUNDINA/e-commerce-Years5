<?php

namespace App\Models;
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    use HasFactory;
    protected $fillabl = ['product_id','order_id'];
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
    
}
