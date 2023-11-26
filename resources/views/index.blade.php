@extends('layouts.app')

@section('title')
    <title>Recruitment App</title>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Timelines</h1>

        <a href="{{ route('timeline.create') }}" class="btn btn-dark float-end -mt-4">New Timeline</a>

        <div class="timeline-container">
            @foreach ($timelines as $timeline)
                <div @if ($loop->first) class="mt-4" @endif>
                    <h5><strong>Recruiter:</strong>
                        {{ $timeline->recruiter_name . ' ' . $timeline->recruiter_surname }}</h5>
                    <h5><strong>Candidate:</strong>
                        {{ $timeline->candidate_name . ' ' . $timeline->candidate_surname }}</h5>
                </div>

                @if (count($timeline->steps) < 3 && $timeline->steps()->latest()->first()->current_status == App\Enums\StatusCategory::COMPLETE->value)
                    <a href="{{ route('step.create', $timeline->id) }}" class="btn btn-dark -mb-4">New Step</a>
                @endif

                <div class="row text-center justify-content-center mb-5">
                    <div class="col-xl-6 col-lg-8">
                        <h3 class="font-weight-bold mb-4">
                            @if (count($timeline->steps))
                                Timeline
                            @else
                                No steps have been created yet...
                            @endif
                        </h3>
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
                                    <div class="d-flex justify-content-center">
                                        <select name="current_status[{{ $step->id }}]"
                                            class="form-control select-small-width centered-select-text"
                                            {{ $step->current_status != 'Pending' ? 'disabled' : '' }}>
                                            @foreach ($status_categories as $status_category)
                                                <option value="{{ $status_category['id'] }}"
                                                    {{ $status_category['title'] == $step->current_status ? 'selected' : '' }}>
                                                    {{ $status_category['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
    @endsection

    @section('styles')
        <style scoped>
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

            .-mt-4 {
                margin-top: -45px;
            }

            .-mb-4 {
                margin-bottom: -45px;
            }

            .select-small-width {
                width: 101px !important;
            }

            .centered-select-text {
                text-align: center;
                text-align-last: center;
                /* For Firefox */
                -moz-text-align-last: center;
                /* Another one for Firefox */
                -webkit-text-align-last: center;
                /* For Safari and Chrome */
            }
        </style>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('select[name^="current_status"]').forEach(function(selectElement) {
                    selectElement.addEventListener('change', function() {
                        var stepId = this.name.match(/\d+/)[0];
                        var newStatus = this.value;

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('status.store') }}', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                        console.log(xhr);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                alert('Status updated successfully');
                                window.location.reload();
                            }
                        };

                        xhr.send(JSON.stringify({
                            step_id: stepId,
                            status_category: newStatus
                        }));
                    });
                });
            });
        </script>
    @endsection
