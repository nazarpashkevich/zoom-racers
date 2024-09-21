<?php

namespace App\Domains\Common\Traits\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait WithFilters
{

    public function filters(): ?Collection
    {
        return collect(Arr::whereNotNull($this->get('filters', [])))
            ->map(function ($value) {
                if (is_string($value)) {
                    if (strtolower($value) === 'true') {
                        return true;
                    } elseif (strtolower($value) === 'false') {
                        return false;
                    }
                }

                return $value;
            });
    }

    protected function filtersRules(): array
    {
        return [
            'filters'   => ['array'],
            'filters.*' => [],
        ];
    }
}
