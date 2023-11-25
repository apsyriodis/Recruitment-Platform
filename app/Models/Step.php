<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeline_id',
        'step_category',
    ];

    protected $appends = [
        'current_status',
    ];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function statuses()
    {
        return $this->hasMany(StepStatusHistory::class);
    }

    public function getCurrentStatusAttribute(): string
    {
        return $this->statuses
            ->latest()
            ->first()
            ->status_category;
    }
}
