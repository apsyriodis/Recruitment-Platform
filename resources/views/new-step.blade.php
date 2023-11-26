@extends('layouts.app')

@section('title')
    <title>New Step</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="d-flex justify-content-center my-5">Add Steps to Timeline</h1>

        <form class="form-container pb-5 pt-4" action="{{ route('step.store', ['timeline_id' => $timeline->id]) }}"
            method="POST">
            @csrf

            <div class="form-group my-3">
                <label for="step_category">Step Category:</label>
                <select class="form-control" id="step_category" name="step_category">
                    @foreach ($step_categories as $step_category)
                        @if (!in_array($step_category['title'], $timeline->steps->pluck('step_category')->toArray()))
                            <option value="{{ $step_category['id'] }}">{{ $step_category['title'] }}</option>
                        @endif
                    @endforeach
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
