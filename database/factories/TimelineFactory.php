<?php

namespace Database\Factories;

use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimelineFactory extends Factory
{
    protected $model = Timeline::class;

    public function definition(): array
    {
        return [
            'candidate_name' => $this->faker->firstName,
            'candidate_surname' => $this->faker->lastName,
            'recruiter_name' => $this->faker->firstName,
            'recruiter_surname' => $this->faker->lastName,
        ];
    }
}
