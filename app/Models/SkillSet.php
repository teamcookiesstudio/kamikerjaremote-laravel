<?php

namespace App\Models;

use App\ModelCaching;

class SkillSet extends ModelCaching
{
    protected $table = 'skill_sets';
    protected $fillable = ['id', 'skill_set_name', 'created_at', 'updated_at'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
