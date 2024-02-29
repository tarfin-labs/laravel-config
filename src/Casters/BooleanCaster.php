<?php

namespace TarfinLabs\LaravelConfig\Casters;

use TarfinLabs\LaravelConfig\Contracts\ConfigCaster;

class BooleanCaster implements ConfigCaster
{
    public function cast($value): bool
    {
        return (bool) $value;
    }
}
