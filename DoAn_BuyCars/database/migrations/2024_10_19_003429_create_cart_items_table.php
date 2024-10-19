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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('CartItemId');
            $table->unsignedBigInteger('CartId');
            $table->unsignedBigInteger('ProductId');
            $table->integer('quantity');
        
            // Khóa ngoại
            $table->foreign('CartId')->references('CartId')->on('cart')->onDelete('cascade');
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
