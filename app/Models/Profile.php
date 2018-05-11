<?php

namespace App\Models;

use App\ModelCaching;

class Profile extends ModelCaching
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'member_id', 'occupation', 'location', 'summary', 'website', 'url_photo_prfile',
        'facebook', 'linkedin', 'upwork',
    ];

    public function skillsets()
    {
        return $this->belongsToMany(SkillSet::class);
    }

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'member_id', 'id');
    }
}
