<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StepResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'timeline_id' => $this->timeline_id,
            'step_category' => $this->step_category,
            'steps' => $this->steps,
            'current_status' => $this->current_status,
        ];
    }
}
