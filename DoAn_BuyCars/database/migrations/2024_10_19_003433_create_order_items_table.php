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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('OrderItemId'); 
            $table->unsignedBigInteger('OrderId'); 
            $table->unsignedBigInteger('ProductId');  
            $table->integer('quantity');
            $table->decimal('price', 18, 2);
        
            // Khóa ngoại
            $table->foreign('OrderId')->references('OrderId')->on('orders')->onDelete('cascade');
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
