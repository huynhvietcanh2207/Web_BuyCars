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
                'price' => 25000.00,
                'description' => 'A reliable and comfortable sedan.',
                'image_url' => 'https://example.com/camry.png',
                'color' => 'Black'
            ],
            [
                'name' => 'Honda Civic',
                'BrandId' => DB::table('brands')->where('BrandName', 'Honda')->value('BrandId'),
                'price' => 22000.00,
                'description' => 'A compact car with great fuel efficiency.',
                'image_url' => 'https://example.com/civic.png',
                'color' => 'Blue'
            ],
            [
                'name' => 'Ford Mustang',
                'BrandId' => DB::table('brands')->where('BrandName', 'Ford')->value('BrandId'),
                'price' => 35000.00,
                'description' => 'A classic American sports car.',
                'image_url' => 'https://example.com/mustang.png',
                'color' => 'Red'
            ],
            [
                'name' => 'Chevrolet Silverado',
                'BrandId' => DB::table('brands')->where('BrandName', 'Chevrolet')->value('BrandId'),
                'price' => 40000.00,
                'description' => 'A strong and durable pickup truck.',
                'image_url' => 'https://example.com/silverado.png',
                'color' => 'Silver'
            ],
            [
                'name' => 'BMW X5',
                'BrandId' => DB::table('brands')->where('BrandName', 'BMW')->value('BrandId'),
                'price' => 60000.00,
                'description' => 'A luxury SUV with superior performance.',
                'image_url' => 'https://example.com/x5.png',
                'color' => 'White'
            ],
            [
                'name' => 'Mercedes-Benz C-Class',
                'BrandId' => DB::table('brands')->where('BrandName', 'Mercedes-Benz')->value('BrandId'),
                'price' => 55000.00,
                'description' => 'A stylish and comfortable luxury sedan.',
                'image_url' => 'https://example.com/c-class.png',
                'color' => 'Gray'
            ],
            // Thêm các sản phẩm khác nếu cần
        ]);
    }
}
