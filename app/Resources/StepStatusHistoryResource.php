<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepStatusHistoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'step_id' => $this->step_id,
            'status_category' => $this->status_category,
            'step' => $this->step,
        ];
    }
}
