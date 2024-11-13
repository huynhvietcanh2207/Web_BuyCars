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
        Schema::create('user_role_assignments', function (Blueprint $table) {
            $table->id('AssignmentId'); // Khóa chính cho bảng này
            $table->unsignedBigInteger('user_id'); // Sử dụng user_id thay cho id để rõ ràng hơn
            $table->unsignedBigInteger('RoleId');
            $table->timestamp('AssignedAt')->useCurrent();
        
            // Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('RoleId')->references('id')->on('user_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role_assignments');
        Schema::dropIfExists('user_roles');
    }
};
