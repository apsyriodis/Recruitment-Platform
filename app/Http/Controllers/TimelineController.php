<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Resources\TimelineResource;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::latest()->get();

        return view('index', ['timelines' => $timelines]);
    }

    public function create()
    {
        return view('new-timeline');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        Timeline::create([
            'recruiter_name' => $request['recruiter_name'],
            'recruiter_surname' => $request['recruiter_surname'],
            'candidate_name' => $request['candidate_name'],
            'candidate_surname' => $request['candidate_surname'],
        ]);

        session()->flash('success', 'Created Successfully!');

        return redirect('/');
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
