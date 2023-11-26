<?php

namespace App\Http\Controllers;

use App\Enums\StatusCategory;
use App\Enums\StepCategory;
use App\Models\Step;
use App\Models\StepStatusHistory;
use App\Models\Timeline;
use App\Resources\TimelineResource;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::latest()->get();

        return view('index', [
            'timelines' => $timelines,
            'status_categories' => StatusCategory::toArray(),
        ]);
    }

    public function create()
    {
        return view('new-timeline');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $timeline = Timeline::create([
            'recruiter_name' => $request['recruiter_name'],
            'recruiter_surname' => $request['recruiter_surname'],
            'candidate_name' => $request['candidate_name'],
            'candidate_surname' => $request['candidate_surname'],
        ]);

        $this->createFirstStep($timeline->id);

        session()->flash('success', 'Timeline Created Successfully!');

        return redirect()->route('home');
    }

    public function show(int $id): TimelineResource
    {
        $timeline = Timeline::find($id);

        return new TimelineResource($timeline);
    }

    private function validateRequest($request): void
    {
        $request->validate([
            'recruiter_name' => ['required'],
            'recruiter_surname' => ['required'],
            'candidate_name' => ['required'],
            'candidate_surname' => ['required'],
        ]);
    }

    private function createFirstStep($timeline_id): void
    {
        $step_id = Step::create([
            'timeline_id' => $timeline_id,
            'step_category' => StepCategory::FIRST_INTERVIEW,
        ])->id;

        StepStatusHistory::create([
            'step_id' => $step_id,
            'status_category' => StatusCategory::PENDING,
        ]);
    }
}
