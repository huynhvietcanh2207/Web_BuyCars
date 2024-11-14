<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            ['name'=>'Huỳnh Viết Cảnh','email'=> 'huynhvietcanh@gmail.com','password'=> Hash::make('Canh123@'), 'profile_image'=> 'mec 001.jpg'],
            ['name'=> 'Trần Bá Triệu','email'=> 'batrieutran43@gmail.com','password'=> Hash::make('Trieu123@'), 'profile_image' => 'mec 001.jpg'],
            ['name'=> 'Lê Văn Đức','email'=> 'levanduc@gmail.com','password'=> Hash::make('Duc123@'), 'profile_image' => 'mec 001.jpg'],
            ['name'=> 'Lại Phú Quý','email'=> 'laiphuquy@gmail.com','password'=> Hash::make('Quy123@'), 'profile_image' => 'mec 001.jpg'],
            ['name'=> 'Lê Anh Khôi','email'=> 'leminhkhoi@gmail.com','password'=> Hash::make('Khoi123@'), 'profile_image' => 'mec 001.jpg'],
        ]);
    }
}
