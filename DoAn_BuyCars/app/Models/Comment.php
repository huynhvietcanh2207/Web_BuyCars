<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $primaryKey = 'CommentId';

    protected $fillable = [
        'ProductId',
        'id',
        'CommentText',
        'CreatedAt',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id'); // 'id' là cột liên kết
    }

    public static function getCommentsByProductId($productId)
    {
        return self::where('ProductId', $productId)->orderBy('CreatedAt', 'desc')->get();
    }
}