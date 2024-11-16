<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Toyota Camry',
                'BrandId' => DB::table('brands')->where('BrandName', 'Toyota')->value('BrandId'),
                'price' => 1000000000000,
                'quantity'=>10,
                'description' => 'A reliable and comfortable sedan.',
                'image_url' => 'mec 001.jpg',
                'color' => 'Black'
            ],
            [
                'name' => 'Honda Civic',
                'BrandId' => DB::table('brands')->where('BrandName', 'Honda')->value('BrandId'),
                'price' => 2000000000000,
                'quantity' => 10,
                'description' => 'A compact car with great fuel efficiency.',
                'image_url' => 'mec 001.jpg',
                'color' => 'Blue'
            ],
            [
                'name' => 'Ford Mustang',
                'BrandId' => DB::table('brands')->where('BrandName', 'Ford')->value('BrandId'),
                'price' => 1000000000000000,
                'quantity' => 10,
                'description' => 'A classic American sports car.',
                'image_url' => 'mec 001.jpg',
                'color' => 'Red'
            ],
            [
                'name' => 'Chevrolet Silverado',
                'BrandId' => DB::table('brands')->where('BrandName', 'Chevrolet')->value('BrandId'),
                'price' => 2900000000000,
                'quantity' => 10,
                'description' => 'A strong and durable pickup truck.',
                'image_url' => 'mec 001.jpg',
                'color' => 'Silver'
            ],
            [
                'name' => 'BMW X5',
                'BrandId' => DB::table('brands')->where('BrandName', 'BMW')->value('BrandId'),
                'price' => 300000000000,
                'quantity' => 10,
                'description' => 'A luxury SUV with superior performance.',
                'image_url' => 'mec 001.jpg',
                'color' => 'White'
            ],
            [
                'name' => 'Mercedes-Benz C-Class',
                'BrandId' => DB::table('brands')->where('BrandName', 'Mercedes-Benz')->value('BrandId'),
                'price' => 4500000000000,
                'quantity' => 10,
                'description' => 'A stylish and comfortable luxury sedan.',
                'image_url' => 'mec 001.jpg',
                'color' => 'Gray'
            ],
            // Thêm các sản phẩm khác nếu cần
        ]);
    }
}
