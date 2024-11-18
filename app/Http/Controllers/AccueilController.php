<?php

namespace App\Http\Controllers;

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
}
