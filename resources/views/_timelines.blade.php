<div class="container">
    <h2 class="text-center my-4">Timelines</h2>

    <div class="timeline-container">
        @foreach ($timelines as $timeline)
            <div @if ($loop->first) class="mt-4" @endif>
                <h5><strong>Recruiter:</strong>
                    {{ $timeline->recruiter_name . ' ' . $timeline->recruiter_surname }}</h5>
                <h5><strong>Candidate:</strong>
                    {{ $timeline->candidate_name . ' ' . $timeline->candidate_surname }}</h5>
            </div>
            <div class="container">
                <div class="row text-center justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-8">
                        <h2 class="font-weight-bold mb-4">Timeline</h2>
                    </div>

                    <div class="timeline">
                        @foreach ($timeline->steps as $index => $step)
                            <div class="step">
                                <div class="circle {{ ['first', 'second', 'third'][$index] }}"></div>

                                <div class='mb-3'>
                                    <p class="my-0"><strong>Step Category:</strong></p>
                                    <span>{{ $step->step_category }}</span>
                                </div>

                                <div>
                                    <p class="my-0"><strong>Current Status Category:</strong></p>
                                    <span>{{ $step->current_status }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (!$loop->last)
                    <hr class='my-5'>
                @endif
        @endforeach
    </div>
</div>

@section('styles')
    <style>
        .timeline-container {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #ffffff;
        }

        .timeline {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .step {
            text-align: center;
            position: relative;
            flex: 1;
        }

        .circle {
            width: 30px;
            height: 30px;
            border: 3px solid #000;
            border-radius: 50%;
            display: inline-block;
        }

        .first {
            border-color: #af4c4c;
        }

        .second {
            border-color: #00e1ff;
        }

        .third {
            border-color: #4CAF50;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 10%;
            left: 65%;
            width: calc(70% - 20px);
            height: 2px;
            background-color: #000;
            transform: translateY(-50%);
        }
    </style>
@endsection
