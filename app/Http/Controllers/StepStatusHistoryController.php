<?php

namespace App\Http\Controllers;

use App\Enums\StatusCategory;
use App\Models\StepStatusHistory;
use App\Resources\StepStatusHistoryResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class StepStatusHistoryController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $status = StepStatusHistory::create([
            'step_id' => $request['step_id'],
            'status_category' => $request['status_category'],
        ]);

        return [
            'message' => 'Created Successfully',
            'entry' => new StepStatusHistoryResource($status),
        ];
    }

    private function validateRequest($request): void
    {
        $request->validate([
            'step_id' => ['required', 'exists:steps,id'],
            'status_category' => ['required', new Enum(StatusCategory::class)],
        ]);
    }
}
