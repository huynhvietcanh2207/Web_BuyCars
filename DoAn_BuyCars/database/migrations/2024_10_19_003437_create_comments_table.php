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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('CommentId');
            $table->unsignedBigInteger('ProductId');
            $table->unsignedBigInteger('UserId');
            $table->text('CommentText');
            $table->timestamp('CreatedAt')->useCurrent();
        
            // Khóa ngoại
            $table->foreign('ProductId')->references('ProductId')->on('products')->onDelete('cascade');
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
