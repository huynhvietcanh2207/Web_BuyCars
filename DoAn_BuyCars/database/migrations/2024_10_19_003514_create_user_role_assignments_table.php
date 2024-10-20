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
            $table->id('AssignmentId');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('RoleId');
            $table->timestamp('AssignedAt')->useCurrent();
        
            // Khóa ngoại
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('RoleId')->references('RoleId')->on('user_roles')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role_assignments');
    }
};
