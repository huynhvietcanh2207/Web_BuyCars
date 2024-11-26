<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id('BrandId');
            $table->string('BrandName')->unique();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->fullText('BrandName');
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropFullText('BrandName');
        });

        Schema::dropIfExists('brands');
    }
};
