<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'step_status_history';

    protected $fillable = [
        'step_id',
        'status_category',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
}
