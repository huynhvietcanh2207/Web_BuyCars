<?php

// App\Models\Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'user_roles'; // Chỉ định bảng nếu tên không theo chuẩn

    /**
     * Thiết lập mối quan hệ nhiều-nhiều với User.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role_assignments', 'RoleId', 'user_id');
    }
}
