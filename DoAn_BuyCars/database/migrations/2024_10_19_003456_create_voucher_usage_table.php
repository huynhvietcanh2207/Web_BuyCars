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
        Schema::create('voucher_usage', function (Blueprint $table) {
            $table->id('VoucherUsageId');
            $table->unsignedBigInteger('VoucherId');
            $table->unsignedBigInteger('UserId');
            $table->timestamp('UsedAt')->useCurrent();
        
            // Khóa ngoại
            $table->foreign('VoucherId')->references('VoucherId')->on('vouchers')->onDelete('cascade');
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_usage');
    }
};
