<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillSet extends Model
{
    protected $table = 'skill_sets';
    protected $fillable = ['id', 'skill_set_name', 'created_at', 'updated_at'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
