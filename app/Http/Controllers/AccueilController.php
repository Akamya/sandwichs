<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('accueil.index', [
            'products' => $products,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::all();
        $orders = Order::all();
        return view('panier.index', [
            'products' =>$products,
            'orders' =>$orders,
        ]);
    }
}
