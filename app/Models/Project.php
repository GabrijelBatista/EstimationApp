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
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function modules()
    {
        return $this->hasMany('App\Models\Module');
    }
}
