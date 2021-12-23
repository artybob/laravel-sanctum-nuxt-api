<?php

namespace App\Helpers;

use App\Http\Services\StreamPlaces\Twitch;

class ExternalApis
{
    public const AVAILABLE_APIS = [Twitch::class];
}
