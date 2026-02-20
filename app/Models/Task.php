<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    protected $fillable = ['description', 'is_completed', 'project_id'];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    // This "booted" function runs every time the Task model is used
    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}