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
        Schema::create('products', function (Blueprint $table) {
            $table->id('ProductId');
            $table->string('name');
            $table->unsignedBigInteger('BrandId');
            $table->decimal('price', 18, 2);
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('color', 50)->nullable();
            $table->timestamps();
        
            // Khóa ngoại tham chiếu đến bảng brands
            $table->foreign('BrandId')->references('BrandId')->on('brands')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
