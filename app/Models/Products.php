<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function productImages()
    {
        return $this->hasMany(ProductsImages::class, 'product_id');
    }
}
