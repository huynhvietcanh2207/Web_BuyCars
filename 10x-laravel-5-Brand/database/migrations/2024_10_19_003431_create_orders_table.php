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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('OrderId');
            $table->unsignedBigInteger('UserId');
            $table->timestamp('OrderDate')->useCurrent();
            $table->decimal('TotalAmount', 18, 2);
            $table->string('OrderStatus', 50);
            $table->timestamps();
        
            // Khóa ngoại
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
