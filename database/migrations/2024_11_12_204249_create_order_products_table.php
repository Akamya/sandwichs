<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sandwich_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('sandwich_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('sandwich_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
            $table->timestampTz('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sandwich_order_products');
    }
};
