<?php

namespace App\Http\Controllers;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\StepStatusHistory;
use App\Models\Timeline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class StepController extends Controller
{
    public function create(Request $request)
    {
        return view('new-step', [
            'timeline' => Timeline::find($request['timeline_id']),
            'step_categories' => StepCategory::toArray(),
            'status_categories' => StatusCategory::toArray(),
        ]);
    }

    public function store(Request $request, $timeline_id)
    {
        $request['timeline_id'] = $timeline_id;

        $this->validateRequest($request);

        $cannotProceed = $this->checkRestrictions($request);

        if ($cannotProceed) {
            return $cannotProceed;
        }

        $this->createStepAndHistory($request);

        session()->flash('success', 'Step Created Successfully!');

        return redirect()->route('home');
    }

    private function validateRequest($request): void
    {
        $request->validate([
            'timeline_id' => ['required', 'exists:timelines,id'],
            'step_category' => ['required', new Enum(StepCategory::class)],
            'status_category' => ['required', new Enum(StatusCategory::class)],
        ]);
    }

    private function createStepAndHistory($request): void
    {
        $step = Step::create([
            'timeline_id' => $request['timeline_id'],
            'step_category' => $request['step_category'],
        ]);

        StepStatusHistory::create([
            'step_id' => $step->id,
            'status_category' => $request['status_category'],
        ]);
    }

    private function checkRestrictions($request): JsonResponse|bool
    {
        $timeline = Timeline::find($request['timeline_id']);

        if (count($timeline->steps) >= 3) {
            return response()->json([
                'message' => 'A timeline cannot have more than 3 steps.'
            ], 422);
        }

        if (in_array($request['step_category'], $timeline->steps->pluck('step_category')->toArray())) {
            return response()->json([
                'message' => 'This step has already been created for this timeline.'
            ], 422);
        }

        return false;
    }
}
