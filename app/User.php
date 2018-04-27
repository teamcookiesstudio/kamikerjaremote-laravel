<?php

namespace App;

use App\Models\Portofolio;
use App\Models\Profile;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'reviewed_by', 'uuid', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'level', 'is_approved', 'reviewed_by',
    ];

    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    public function scopeAdmin($query)
    {
        return $query->where('level', static::ACCESS_ADMIN);
    }

    public function scopeMember($query)
    {
        return $query->where('level', static::ACCESS_MEMBER);
    }

    public function scopeFindByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->firstOrFail();
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

    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'member_id', 'id');
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

    public function getStatusAttribute()
    {
        if ($this->is_approved == false && !is_null($this->reviewed_by)) {
            return 'rejected';
        }

        if (is_null($this->is_approved)) {
            return 'waiting approval';
        }

        if ($this->is_approved == true) {
            return 'approved';
        }
    }
}
