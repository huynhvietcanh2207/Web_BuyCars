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
            ['BrandName' => 'Toyota', 'image_url' => 'https://example.com/toyota.png'],
            ['BrandName' => 'Honda', 'image_url' => 'https://example.com/honda.png'],
            ['BrandName' => 'Ford', 'image_url' => 'https://example.com/ford.png'],
            ['BrandName' => 'Chevrolet', 'image_url' => 'https://example.com/chevrolet.png'],
            ['BrandName' => 'Nissan', 'image_url' => 'https://example.com/nissan.png'],
            ['BrandName' => 'BMW', 'image_url' => 'https://example.com/bmw.png'],
            ['BrandName' => 'Mercedes-Benz', 'image_url' => 'https://example.com/mercedes.png'],
            ['BrandName' => 'Volkswagen', 'image_url' => 'https://example.com/volkswagen.png'],
            ['BrandName' => 'Hyundai', 'image_url' => 'https://example.com/hyundai.png'],
            ['BrandName' => 'Kia', 'image_url' => 'https://example.com/kia.png'],
            ['BrandName' => 'Subaru', 'image_url' => 'https://example.com/subaru.png'],
            ['BrandName' => 'Lexus', 'image_url' => 'https://example.com/lexus.png'],
            ['BrandName' => 'Mazda', 'image_url' => 'https://example.com/mazda.png'],
            ['BrandName' => 'Porsche', 'image_url' => 'https://example.com/porsche.png'],
            ['BrandName' => 'Jaguar', 'image_url' => 'https://example.com/jaguar.png'],
        ]);
    }
}
