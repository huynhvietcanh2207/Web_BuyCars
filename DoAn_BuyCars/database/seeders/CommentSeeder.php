<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [];

        for ($i = 1; $i <= 50; $i++) { // Tạo 5000 bản ghi
            $comments[] = [
                'ProductId' => 8,
                'id' => 1,
                'CommentText' => 'Sample comment text ' . $i,
                'CreatedAt' => now(),
            ];

            // Chèn theo batch 500 để tránh quá tải
            if ($i % 50 === 0) {
                DB::table('comments')->insert($comments);
                $comments = []; // Reset mảng sau mỗi lần chèn
            }
        }

        // Chèn những bản ghi còn lại
        if (!empty($comments)) {
            DB::table('comments')->insert($comments);
        }
    }
}
