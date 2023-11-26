@extends('layouts.app')

@section('title')
    <title>New Step</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="d-flex justify-content-center my-5">Create a Step for the Timeline #{{ $timeline->id }}</h1>

        <form class="form-container pb-5 pt-4" action="{{ route('step.store', ['timeline_id' => $timeline->id]) }}"
            method="POST">
            @csrf

            <div class="form-group my-3">
                <label for="step_category">Step Category:</label>
                <select class="form-control" id="step_category" name="step_category">
                    @if ($timeline->latestStepCategory() == App\Enums\StepCategory::FIRST_INTERVIEW->value)
                        <option value="{{ App\Enums\StepCategory::TECH_ASSESSMENT->value }}">
                            {{ App\Enums\StepCategory::TECH_ASSESSMENT->value }}</option>
                    @else
                        <option value="{{ App\Enums\StepCategory::OFFER->value }}">
                            {{ App\Enums\StepCategory::OFFER->value }}</option>
                    @endif
                </select>
            </div>

            <div class="form-group my-3">
                <label for="status_category">Status:</label>
                <select class="form-control" id="status_category" name="status_category">
                    @foreach ($status_categories as $status_category)
                        <option value="{{ $status_category['id'] }}">{{ $status_category['title'] }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="timeline_id" value="{{ $timeline->id }}">

            <button type="submit" class="btn btn-dark float-end">Create</button>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        .form-container {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #ffffff;
        }
    </style>
@endsection
