<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
                    ->withPivot('quantity', 'price', 'total_price')
                    ->withTimestamps();
    }
}
