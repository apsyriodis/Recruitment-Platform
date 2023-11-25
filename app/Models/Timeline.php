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
}
