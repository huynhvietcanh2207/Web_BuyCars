<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Khai báo bảng tương ứng
    protected $table = 'activity_logs';

    // Các trường có thể gán giá trị hàng loạt
    protected $fillable = [
        'user_id',
        'action',
    ];

    // Thiết lập quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}