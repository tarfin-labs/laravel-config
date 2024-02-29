<?php

namespace TarfinLabs\LaravelConfig\Casters;

use Carbon\Carbon;
use TarfinLabs\LaravelConfig\Contracts\ConfigCaster;

class DateTimeCaster implements ConfigCaster
{
    public function cast($value): Carbon
    {
        return Carbon::createFromFormat('Y-m-d H:i', $value);
    }
}
