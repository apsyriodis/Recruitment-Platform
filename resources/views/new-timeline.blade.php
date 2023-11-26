@extends('layouts.app')

@section('title')
    <title>New Timeline</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="d-flex justify-content-center my-5">Create Timeline</h1>

        <form class="form-container pb-5 pt-4" action="{{ route('timeline.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="recruiter_name">Recruiter Name:</label>
                <input type="text" class="form-control" id="recruiter_name" name="recruiter_name" required>
            </div>

            <div class="form-group mt-3">
                <label for="recruiter_surname">Recruiter Surname:</label>
                <input type="text" class="form-control" id="recruiter_surname" name="recruiter_surname" required>
            </div>

            <div class="form-group mt-3">
                <label for="candidate_name">Candidate Name:</label>
                <input type="text" class="form-control" id="candidate_name" name="candidate_name" required>
            </div>

            <div class="form-group my-3">
                <label for="candidate_surname">Candidate Surname:</label>
                <input type="text" class="form-control" id="candidate_surname" name="candidate_surname" required>
            </div>

            <button type="submit" class="btn btn-dark float-end">Create</button>
        </form>
    </div>
@endsection

@section('styles')
    <style scoped>
        .form-container {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #ffffff;
        }
    </style>
@endsection
