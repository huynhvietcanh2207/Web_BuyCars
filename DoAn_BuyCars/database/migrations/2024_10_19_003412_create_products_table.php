<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('ProductId'); // Khóa chính
            $table->string('name');
            $table->unsignedBigInteger('BrandId');
            $table->foreign('BrandId')->references('id')->on('brands')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0); // Thêm trường số lượng
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
