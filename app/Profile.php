<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\SkillSet;

class Profile extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'member_id', 'occupation', 'location', 'summary', 'website', 'url_photo_prfile',
    ];

    public function skillsets()
    {
        return $this->belongsToMany(SkillSet::class);
    }
}
