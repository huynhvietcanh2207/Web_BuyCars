<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleAssignment extends Model
{
    use HasFactory;
    protected $table = 'user_role_assignments';

    protected $primaryKey = 'AssignmentId';

    protected $fillable = ['user_id', 'RoleId', 'AssignedAt'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'RoleId');
    }
}
