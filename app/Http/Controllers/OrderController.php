<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Log::info('hello1');
        // Validation des données envoyées
        $validated = $request->validate([
            'panier' => 'required|array',
            'total' => 'required|numeric',
        ]);

        Log::info('hello2');
        // Création d'une nouvelle commande
        $order = Order::create([
            'user_id' => auth()->id(),
            'payment' => 0,
            'total' => $validated['total'],
        ]);
        Log::info('hello3');

        // Enregistrement des produits dans la table pivot (order_product)
        foreach ($validated['panier'] as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'quantity' => $item['quantity'],
                'size' => isset($item['size']) ? $item['size'] : null, // Si la taille n'est pas définie, c'est null
            ]);
        }
        Log::info('hello4');

        // Réponse en retour après la création de la commande
        return response()->json(['success' => true]);
    }
}
