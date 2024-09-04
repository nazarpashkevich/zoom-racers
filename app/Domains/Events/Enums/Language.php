<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Traits\Enum\ApiDictionarible;

enum Language: string
{
    use ApiDictionarible;

    case English = 'en';
    case Spanish = 'es';
    case Deutsch = 'de';
    case Other = 'other';
}
