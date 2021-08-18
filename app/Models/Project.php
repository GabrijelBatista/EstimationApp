<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'best_hours',
        'best_minutes',
        'average_hours',
        'average_minutes',
        'worst_hours',
        'worst_minutes',
        'user_id',
        'assigned_id',
        'pm_id',
        'sent_notsent',
        'approved_notapproved',
        'public_private',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function assigned()
    {
        return $this->belongsTo('App\Models\User', 'assigned_id');
    }
    public function pm()
    {
        return $this->belongsTo('App\Models\User', 'pm_id');
    }
    public function modules()
    {
        return $this->hasMany('App\Models\Module');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
