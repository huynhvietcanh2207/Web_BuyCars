<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            // Chỉnh sửa trường ExpirationDate
            $table->timestamp('ExpirationDate')->default(null)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            // Khôi phục lại trường nếu cần
            $table->timestamp('ExpirationDate')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }
};
