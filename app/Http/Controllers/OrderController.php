<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $products = Product::all();

        return view('order.index', [
            'orders' => $orders,
            'products' =>$products,
        ]);
    }
}
