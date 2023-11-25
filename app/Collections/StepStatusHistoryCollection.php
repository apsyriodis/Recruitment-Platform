<?php

namespace App\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StepStatusHistoryCollection extends ResourceCollection
{
    public $collects = 'App\Resources\StepStatusHistoryResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
