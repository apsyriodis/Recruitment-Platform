<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StepCategory: string
{
    use EnumTrait;

    case FIRST_INTERVIEW = '1st Interview';
    case TECH_ASSESSMENT = 'Tech Assessment';
    case OFFER = 'Offer';
}
