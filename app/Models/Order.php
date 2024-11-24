<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'sandwich_orders';
    protected $fillable = [
        'user_id',
        'payment',
        'status',
        'total',
    ];
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Récupère tous les produits dans une commande
    public function products()
{
    return $this->belongsToMany(Product::class)->using(OrderProduct::class)->withPivot('quantity');
}

}
