<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nama_product',
        'harga',
        'spesifikasi',
        'image_path',
        'new_column',
    ];

    use HasFactory;

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
                    ->withPivot('quantity', 'price', 'total_price')
                    ->withTimestamps();
    }
}
