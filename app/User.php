<?php

namespace app;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profile;

class User extends Authenticatable
{
    const ACCESS_ADMIN = 1;
    const ACCESS_MEMBER = 2;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'level', 'is_approved',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'level', 'is_approved', 'approved_by',
    ];

    public function scopeAdmin($query)
    {
        return $query->where('level', static::ACCESS_ADMIN);
    }
    public function scopeMember($query)
    {
        return $query->where('level', static::ACCESS_MEMBER);
    }
    public function isMember()
    {
        return $this->level == static::ACCESS_MEMBER;
    }
    public function isAdmin()
    {
        return $this->level == static::ACCESS_ADMIN;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'member_id');
    }

    public function scopeWaitingApproval($query)
    {
        return $query->whereNull('is_approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
