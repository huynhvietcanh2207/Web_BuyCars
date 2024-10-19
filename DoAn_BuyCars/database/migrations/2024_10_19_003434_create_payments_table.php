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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('PaymentId');
            $table->unsignedBigInteger('OrderId');
            $table->timestamp('PaymentDate')->useCurrent();
            $table->decimal('Amount', 18, 2);
            $table->string('PaymentMethod', 50);
            $table->string('PaymentStatus', 50);
        
            // Khóa ngoại
            $table->foreign('OrderId')->references('OrderId')->on('orders')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
