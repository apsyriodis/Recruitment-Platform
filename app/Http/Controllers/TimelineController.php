<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Resources\TimelineResource;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::all();

        return view('index', ['timelines' => $timelines]);
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

        return [
            'message' => 'Created Successfully',
            'entry' => new TimelineResource($timeline),
        ];
    }

    public function show(Timeline $timeline)
    {
        return new TimelineResource($timeline);
    }

    public function validateRequest($request): void
    {
        $request->validate([
            'recruiter_name' => ['required'],
            'recruiter_surname' => ['required'],
            'candidate_name' => ['required'],
            'candidate_surname' => ['required'],
        ]);
    }
}
