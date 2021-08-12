<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
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
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
