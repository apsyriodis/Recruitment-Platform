<?php

namespace Tests\Feature;

use App\Enums\StatusCategory;
use App\Models\Step;
use Tests\TestCase;

class StepStatusHistoryFeatureTest extends TestCase
{
    public function test_can_store_a_new_status()
    {
        $step_id = Step::factory()->create()->id;

        $payload = [
            'step_id' => $step_id,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $response = $this->postJson('/api/step-status-history', $payload);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Created Successfully',
            'entry' => [
                'step_id' => $step_id,
                'status_category' => StatusCategory::PENDING->value,
            ]
        ]);

        $this->assertDatabaseHas('step_status_history', $payload);
    }

    public function test_can_validate_request()
    {
        $response = $this->postJson('/api/step-status-history', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['step_id', 'status_category']);
    }
}
