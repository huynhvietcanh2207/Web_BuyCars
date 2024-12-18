<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'phone_number',
        'password',
        'profile_image',
    ];
    //thiết lập quan hệ giữa user_role_assignments
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role_assignments', 'user_id', 'RoleId');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Quan hệ với Favorite
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id'); // user_id là khóa ngoại
    }

    //Quan hệ với roleAssignments
    public function roleAssignments()
    {
        return $this->hasMany(UserRoleAssignment::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}