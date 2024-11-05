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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleId');
    }

    public function showCommentsForm($productId)
    {
        $user = auth()->user();
        $isBannedFromCommenting = false;

        if ($user) {
            // Kiểm tra nếu người dùng có RoleId = 2
            $assignment = UserRoleAssignment::where('user_id', $user->id)->where('RoleId', 2)->first();
            $isBannedFromCommenting = $assignment ? true : false;
        }

        $comments = Comment::where('product_id', $productId)->get();
        return view('product.comments', compact('comments', 'isBannedFromCommenting', 'productId'));
    }
}