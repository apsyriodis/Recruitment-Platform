<?php

namespace App\Traits;

trait EnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array
    {
        $categories = [];
        $cases = self::cases();

        foreach ($cases as $case) {
            $categories[] = [
                'id' => $case->value,
                'title' => $case->value,
            ];
        }

        return $categories;
    }
}
