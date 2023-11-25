<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_name',
        'candidate_surname',
        'recruiter_name',
        'recruiter_surname',
    ];

    protected $appends = [
        'current_status',
        'step_category',
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function getCurrentStatusAttribute(): ?string
    {
        return $this->steps()
            ->latest()
            ->first()
            ?->current_status;
    }

    public function getStepCategoryAttribute(): ?string
    {
        return $this->steps()
            ->latest()
            ->first()
            ?->step_category;
    }
}
