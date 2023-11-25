<?php

namespace App\Http\Controllers;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\StepStatusHistory;
use App\Resources\StepResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class StepController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $step = Step::create([
            'timeline_id' => $request['timeline_id'],
            'step_category' => $request['step_category'],
        ]);

        StepStatusHistory::create([
            'step_id' => $step->id,
            'status_category' => $request['status_category'],
        ]);

        return [
            'message' => 'Created Successfully',
            'entry' => new StepResource($step),
        ];
    }

    public function validateRequest($request): void
    {
        $request->validate([
            'timeline_id' => ['required', 'exists:timelines,id'],
            'step_category' => ['required', new Enum(StepCategory::class)],
            'status_category' => ['required', new Enum(StatusCategory::class)],
        ]);
    }
}
