<?php

namespace TarfinLabs\LaravelConfig\Casters;

use TarfinLabs\LaravelConfig\Contracts\ConfigCaster;

class JsonCaster implements ConfigCaster
{
    public function __construct(public ?bool $associative = true, public int $depth = 512, public int $flags = 0)
    {
    }

    public function cast($value)
    {
        $decodedValue = json_decode($value, $this->associative, $this->depth, $this->flags);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decodedValue;
        }

        return $value;
    }
}
