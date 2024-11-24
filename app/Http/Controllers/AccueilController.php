<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function index()
    {
        $userID = (Auth::id());
        $products = Product::all();

        return view('accueil.index', [
            'products' => $products,
            'userID' => $userID,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::all();
        // $orders = Order::all();
        $userID = (Auth::id());
        return view('panier.index', [
            'products' =>$products,
            // 'orders' =>$orders,
            'userID' =>$userID,
        ]);
    }
}
