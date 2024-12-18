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

            $table->id();
            $table->string('order_code')->unique();
            $table->decimal('total', 10, 2);
            $table->string('status'); // Ví dụ: 'Đã thanh toán', 'Đang xử lý'
            $table->timestamp('payment_date')->nullable();
            $table->unsignedBigInteger('user_id'); // Liên kết với bảng users
            $table->timestamps();
         });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('TotalAmount')->nullable(false)->change();  // Không cho phép NULL
        });
    }
};
