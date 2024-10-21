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
            $table->id('FavoriteId'); // Khóa chính
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('ProductId'); // ID sản phẩm
            $table->timestamps();
        
            // Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Khóa ngoại đến bảng users
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade'); // Khóa ngoại đến bảng products
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
