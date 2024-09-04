<?php

namespace App\Domains\Events\Enums;

use App\Domains\Common\Traits\Enum\ApiDictionarible;

enum Platform: string
{
    use ApiDictionarible;

    case GoogleMeet = 'google_meet';
    case Zoom = 'zoom';
    case MicrosoftTeams = 'microsoft_teams';
    case Other = 'other';
}
