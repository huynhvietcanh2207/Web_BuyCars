<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments'; // Tên bảng nếu khác với mặc định

    protected $primaryKey = 'CommentId'; // Tên của khóa chính nếu không phải là 'id'

    // Các trường có thể gán dữ liệu tự động
    protected $fillable = [
        'ProductId',
        'id', // id của người dùng
        'CommentText',
        'CreatedAt',
    ];

    // Tắt timestamps nếu bạn đang sử dụng các tên cột không chuẩn như `CreatedAt`
    public $timestamps = false;
}