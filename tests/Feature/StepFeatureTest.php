<?php

namespace Tests\Feature;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Timeline;
use Tests\TestCase;

class StepFeatureTest extends TestCase
{
    public function test_can_store_a_new_step_with_step_status_history()
    {
        $timeline = Timeline::factory()->create();

        $payload = [
            'timeline_id' => $timeline->id,
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $response = $this->postJson('/api/step', $payload);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Created Successfully',
            'entry' => [
                'timeline_id' => $timeline->id,
                'step_category' => StepCategory::FIRST_INTERVIEW->value,
            ]
        ]);

        $this->assertDatabaseHas('steps', [
            'timeline_id' => $timeline->id,
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
        ]);

        $this->assertDatabaseHas('step_status_history', [
            'status_category' => StatusCategory::PENDING->value,
        ]);
    }

    public function test_can_validate_request()
    {
        $response = $this->postJson('/api/step', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['timeline_id', 'step_category', 'status_category']);
    }
}
