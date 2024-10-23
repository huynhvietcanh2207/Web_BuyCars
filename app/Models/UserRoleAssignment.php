<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleAssignment extends Model
{
    use HasFactory;

    // Tắt timestamps
    public $timestamps = false;

    // Định nghĩa các trường có thể được gán giá trị
    protected $fillable = [
        'user_id',
        'RoleId',
        'AssignedAt',
    ];

    // Khai báo kiểu dữ liệu cho các thuộc tính (tuỳ chọn)
    protected $casts = [
        'AssignedAt' => 'datetime',
    ];
}