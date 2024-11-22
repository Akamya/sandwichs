<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [AccueilController::class, 'index'])->name('accueil');
    Route::get('/panier', [AccueilController::class, 'show'])->name('panier');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Gestion des articles (création, modification, suppression)
    Route::resource('/products', AdminProductController::class);

    // Gestion des utilisateurs (Détails et changement de rôle)
    Route::resource('/users', AdminUserController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
