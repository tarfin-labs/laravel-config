<?php

namespace TarfinLabs\LaravelConfig\Config;

class ConfigItem
{
    /** @var string */
    public $name;

    /** @var string */
    public $val;

    /** @var string */
    public $type = 'boolean';

    /** @var string|null */
    public $description = null;
}
