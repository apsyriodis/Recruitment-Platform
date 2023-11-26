<?php

namespace Tests\Feature;

use App\Models\Timeline;
use Tests\TestCase;

class TimelineFeatureTest extends TestCase
{
    public function test_can_store_a_new_timeline()
    {
        $payload = [
            'recruiter_name' => 'John',
            'recruiter_surname' => 'Doe',
            'candidate_name' => 'Jane',
            'candidate_surname' => 'Smith',
        ];

        $this->postJson('/api/timeline', $payload);

        $this->assertDatabaseHas('timelines', $payload);
    }

    public function test_can_validate_request()
    {
        $response = $this->postJson('/api/timeline', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['recruiter_name', 'recruiter_surname', 'candidate_name', 'candidate_surname']);
    }

    public function test_can_get_specific_timeline()
    {
        $timeline = Timeline::factory()->create();

        $response = $this->getJson('/api/timeline/' . $timeline->id);

        $response->assertStatus(200);
    }
}
