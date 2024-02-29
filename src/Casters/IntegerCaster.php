<?php

namespace TarfinLabs\LaravelConfig\Casters;

use TarfinLabs\LaravelConfig\Contracts\ConfigCaster;

class IntegerCaster implements ConfigCaster
{

    public function cast($value): int
    {
        return (int) $value;
    }
}
