<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 'current_position', 'location', 'summary', 'website', 'url_photo_prfile',
    ];
}
