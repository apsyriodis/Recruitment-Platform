<?php

namespace Database\Seeders;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\StepStatusHistory;
use App\Models\Timeline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $step_categories = StepCategory::toArray();
        Timeline::factory(1)->create();

        DB::transaction(function () use ($step_categories) {
            $timeline_ids = Timeline::pluck('id');

            foreach ($timeline_ids as $timeline_id) {
                for ($i = 0; $i < count($step_categories); $i++) {
                    $step_id = Step::factory()->create([
                        'timeline_id' => $timeline_id,
                        'step_category' => $step_categories[$i]['title']
                    ])->id;

                    StepStatusHistory::factory()->create([
                        'step_id' => $step_id,
                        'status_category' => StatusCategory::COMPLETE,
                    ]);
                }
            }
        });
    }
}
