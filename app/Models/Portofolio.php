<?php

namespace App\Models;

use App\ModelCaching;

class Portofolio extends ModelCaching
{
    protected $table = 'portofolio';
    protected $fillable = [
        'id', 'member_id', 'project_name', 'start_date', 'end_date', 'project_on_going',
        'thumbnail', 'description', 'project_url',
    ];

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'member_id', 'id');
    }
}
