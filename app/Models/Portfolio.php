<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Portfolio extends Model
{
    protected $table = "portfolio";
    protected $fillable = [
        'id', 'member_id', 'project_name', 'start_date', 'end_date', 'project_on_going',
        'thumbnail', 'description'
    ];

    public function scopeFindMember($query, $id)
    {
        $query->where('member_id', $id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
