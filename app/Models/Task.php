<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
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
        'module_id'
    ];

    public function modules()
    {
        return $this->belongsTo('App\Models\Module');
    }
}
