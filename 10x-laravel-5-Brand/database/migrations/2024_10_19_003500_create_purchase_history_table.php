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
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->id('PurchaseId');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('OrderId');
            $table->timestamp('PurchaseDate')->useCurrent();
            $table->decimal('TotalAmount', 18, 2);
            $table->string('PaymentMethod', 50);
            $table->string('OrderStatus', 50);
        
            // Khóa ngoại
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
            $table->foreign('OrderId')->references('OrderId')->on('orders')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_history');
    }
};
