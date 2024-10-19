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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('FavoriteId');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('ProductId');
            $table->timestamp('CreatedAt')->useCurrent();
        
            // Khóa ngoại
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
