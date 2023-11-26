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
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $this->postJson("/api/step/{$timeline->id}", $payload);

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
        $response = $this->postJson('/api/step/1', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['step_category', 'status_category']);
    }

    public function test_cannot_create_over_3_steps_for_a_timeline()
    {
        $timeline = Timeline::factory()->create();

        $step_categories = StepCategory::toArray();
        $status_categories = StatusCategory::toArray();

        for ($i = 0; $i < 3; $i++) {
            $payload = [
                'step_category' => $step_categories[$i]['title'],
                'status_category' => $status_categories[$i]['title'],
            ];

            $this->postJson("/api/step/{$timeline->id}", $payload);

            $this->assertDatabaseHas('steps', [
                'timeline_id' => $timeline->id,
                'step_category' => $step_categories[$i]['title'],
            ]);

            $this->assertDatabaseHas('step_status_history', [
                'status_category' => $status_categories[$i]['title'],
            ]);
        }

        $response = $this->postJson("/api/step/{$timeline->id}", $payload);

        $response->assertStatus(422);
    }

    public function test_cannot_create_an_existing_step_for_a_timeline()
    {
        $timeline = Timeline::factory()->create();

        $payload = [
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
            'status_category' => StatusCategory::PENDING->value,
        ];

        for ($i = 1; $i < 3; $i++) {
            $response = $this->postJson("/api/step/{$timeline->id}", $payload);
        }

        $response->assertStatus(422);
    }
}
