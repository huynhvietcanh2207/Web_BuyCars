<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            [
                'BrandId' => 1,
                'BrandName' => 'Toyota',
                'image_url' => 'images/toyota.jpg',
                'created_at' => Carbon::parse('2024-11-14 09:32:57'),
                'updated_at' => Carbon::parse('2024-11-23 09:30:57'),
            ],
            [
                'BrandId' => 2,
                'BrandName' => 'Honda',
                'image_url' => 'images/honda.jpg',
                'created_at' => Carbon::parse('2024-11-15 09:33:00'),
                'updated_at' => Carbon::parse('2024-11-23 09:31:09'),
            ],
            [
                'BrandId' => 3,
                'BrandName' => 'Fordd',
                'image_url' => 'images/ford.jpg',
                'created_at' => Carbon::parse('2024-11-16 09:33:03'),
                'updated_at' => Carbon::parse('2024-11-23 09:32:04'),
            ],
            [
                'BrandId' => 6,
                'BrandName' => 'B M W',
                'image_url' => 'images/bmw.jpg',
                'created_at' => Carbon::parse('2024-11-17 09:33:06'),
                'updated_at' => Carbon::parse('2024-11-23 09:31:57'),
            ],
            [
                'BrandId' => 7,
                'BrandName' => 'Mercedes-Benz',
                'image_url' => 'images/logoMec.jpg',
                'created_at' => Carbon::parse('2024-11-19 09:33:09'),
                'updated_at' => Carbon::parse('2024-11-23 09:32:24'),
            ],
            [
                'BrandId' => 14,
                'BrandName' => 'Porsche',
                'image_url' => 'images/Porsche.jpg',
                'created_at' => Carbon::parse('2024-11-22 09:33:14'),
                'updated_at' => Carbon::parse('2024-11-23 09:32:32'),
            ],
        ]);
    }
}
