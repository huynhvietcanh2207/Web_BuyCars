<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_roles';

    protected $fillable = ['RoleName', 'Description'];

    //Quan hệ với roleAssigments
    public function roleAssignments()
    {
        return $this->hasMany(UserRoleAssignment::class, 'RoleId');
    }
}
