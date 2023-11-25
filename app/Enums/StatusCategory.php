<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StatusCategory: string
{
    use EnumTrait;

    case PENDING = 'Pending';
    case COMPLETE = 'Complete';
    case REJECT = 'Reject';
}
