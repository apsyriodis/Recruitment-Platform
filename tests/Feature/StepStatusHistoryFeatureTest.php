<?php

namespace Tests\Feature;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StepStatusHistoryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_a_new_status()
    {
        $step_id = Step::factory()->create([
            'timeline_id' => Timeline::factory()->create()->id,
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
        ])->id;

        $payload = [
            'step_id' => $step_id,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $this->postJson('/api/step-status-history', $payload);

        $this->assertDatabaseHas('step_status_history', $payload);
    }

    public function test_can_validate_request()
    {
        $response = $this->postJson('/api/step-status-history', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['step_id', 'status_category']);
    }

    public function test_can_change_only_pending_status()
    {
        $step_id = Step::factory()->create([
            'timeline_id' => Timeline::factory()->create()->id,
            'step_category' => StepCategory::FIRST_INTERVIEW->value,
        ])->id;

        // pending status
        $payload = [
            'step_id' => $step_id,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $this->postJson('/api/step-status-history', $payload);

        $this->assertDatabaseHas('step_status_history', $payload);

        // complete status
        $payload = [
            'step_id' => $step_id,
            'status_category' => StatusCategory::COMPLETE->value,
        ];

        $this->postJson('/api/step-status-history', $payload);

        $this->assertDatabaseHas('step_status_history', $payload);

        // again pending - should not proceed
        $payload = [
            'step_id' => $step_id,
            'status_category' => StatusCategory::PENDING->value,
        ];

        $response = $this->postJson('/api/step-status-history', $payload);

        $response->assertStatus(422);
    }
}
