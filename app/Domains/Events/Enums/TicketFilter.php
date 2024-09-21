<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Filters\Filter;
use App\Domains\Events\Filters\Ticket\ShowCancelled;
use App\Domains\Events\Filters\Ticket\ShowPast;
use App\Domains\Events\Filters\Ticket\UserFilter;

enum TicketFilter: string
{
    case User = 'user';
    case ShowPast = 'showPast';
    case ShowCancelled = 'showCancelled';

    public function createFilter(mixed $value): Filter
    {
        return match ($this) {
            self::User          => new UserFilter($value),
            self::ShowPast      => new ShowPast($value),
            self::ShowCancelled => new ShowCancelled($value),
        };
    }
}
