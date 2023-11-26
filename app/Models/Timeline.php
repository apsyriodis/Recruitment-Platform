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

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function stepCategories(): array
    {
        return $this->steps
            ->pluck('step_category')
            ->toArray();
    }

    public function latestStepCategory(): string
    {
        return $this->steps()
            ->latest()
            ->first()
            ->step_category;
    }
}
