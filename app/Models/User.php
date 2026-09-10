<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /** Approval states for the is_approved column. */
    public const APPROVAL_PENDING = 0;
    public const APPROVAL_APPROVED = 1;
    public const APPROVAL_REJECTED = -1;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_approved',
        'facebook_link',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'integer',
        ];
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'owner_id');
    }

    public function localNotifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isApproved(): bool
    {
        return (int) $this->is_approved === self::APPROVAL_APPROVED;
    }
}
