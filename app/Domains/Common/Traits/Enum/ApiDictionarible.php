<?php

namespace App\Domains\Common\Traits\Enum;

use Illuminate\Support\Str;

trait ApiDictionarible
{
    // @todo tranfer to frontend in some way
    public static function options(): array
    {
        $cases = static::cases();
        $options = [];
        foreach ($cases as $case) {
            $options[] = [
                'value' => $case->value,
                'title' => Str::headline($case->name),
            ];
        }

        return $options;
    }

}
