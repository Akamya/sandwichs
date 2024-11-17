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
        Schema::create('sandwich_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('prix')->nullable();
            $table->integer('prix_normal')->nullable();
            $table->integer('prix_grand')->nullable();
            $table->string('categorie');
            $table->string('description')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sandwich_products');
    }
};
