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
        Schema::create('sandwich_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('sandwich_users')->onDelete('cascade');
            $table->boolean('payment');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestampTz('published_at')->nullable();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sandwich_orders');
    }
};
