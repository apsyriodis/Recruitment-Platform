<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimelineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'candidate_name' => $this->candidate_name,
            'candidate_surname' => $this->candidate_surname,
            'recruiter_name' => $this->recruiter_name,
            'recruiter_surname' => $this->recruiter_surname,
            'steps' => $this->steps,
        ];
    }
}
