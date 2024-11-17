<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'sandwich_products';
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // Récupère toutes les commandes dans un produit
    public function orders()
{
    return $this->belongsToMany(Order::class)->using(OrderProduct::class)->withPivot('quantity');
}

}
