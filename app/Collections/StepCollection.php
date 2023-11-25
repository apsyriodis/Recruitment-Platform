<?php

namespace App\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StepCollection extends ResourceCollection
{
    public $collects = 'App\Resources\StepResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
