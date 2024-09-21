<?php

namespace App\Domains\Events\Filters\Ticket;

use App\Domains\Common\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    public function filter(Builder $query): Builder
    {
        return $query->where('user_id', $this->value);
    }
}
