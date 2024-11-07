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
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('ProductId');
            $table->integer('quantity');
            $table->decimal('price', 18, 2);
            $table->timestamp('updated_at')->useCurrent();

            // Khóa ngoại
            $table->foreign('UserId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade');
            $table->unique(['ProductId']);
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
