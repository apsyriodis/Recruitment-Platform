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

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function statuses()
    {
        return $this->hasMany(StepStatusHistory::class);
    }
}
