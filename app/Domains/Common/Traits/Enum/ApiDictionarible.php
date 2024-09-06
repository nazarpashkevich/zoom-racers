<?php

namespace App\Domains\Common\Traits\Enum;

use Illuminate\Support\Str;

trait ApiDictionarible
{
    public static function options(): array
    {
        return array_map(fn (self $case) => static::toResource($case), static::cases());
    }

    public function toArray(): array
    {
        return static::toResource($this);
    }

    public static function toResource(self $enum): array
    {
        return [
            'value' => $enum->value,
            'title' => Str::headline($enum->name),
        ];
    }
}
