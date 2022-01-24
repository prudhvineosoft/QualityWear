<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderManagement extends Model
{
    use HasFactory;
    public function productDetails()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
