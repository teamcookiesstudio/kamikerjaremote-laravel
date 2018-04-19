<?php

namespace App;

use App\Models\SkillSet;
use Illuminate\Database\Eloquent\Model;

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
