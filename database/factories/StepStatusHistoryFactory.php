<?php

namespace Database\Factories;

use App\Enums\StatusCategory;
use App\Models\Step;
use App\Models\StepStatusHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepStatusHistoryFactory extends Factory
{
    protected $model = StepStatusHistory::class;

    public function definition(): array
    {
        return [
            'step_id' => Step::factory()->create()->id,
            'status_category' => StatusCategory::PENDING,
        ];
    }
}
