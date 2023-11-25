<?php

namespace Database\Factories;

use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    protected $model = Step::class;

    public function definition(): array
    {
        return [];
    }
}
