<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa toàn bộ dữ liệu trong bảng brands
        DB::table('brands')->truncate();

        // Chèn dữ liệu vào bảng brands
        DB::table('brands')->insert([
            ['BrandName' => 'Toyota', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Honda', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Ford', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Chevrolet', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Nissan', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'BMW', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Mercedes-Benz', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Volkswagen', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Hyundai', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Kia', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Subaru', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Lexus', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Mazda', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Porsche', 'image_url' => 'mec 001.jpg'],
            ['BrandName' => 'Jaguar', 'image_url' => 'mec 001.jpg'],
        ]);
    }
}
