<?php

namespace App\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TimelineCollection extends ResourceCollection
{
    public $collects = 'App\Resources\TimelineResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
