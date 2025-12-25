<?php

namespace TarfinLabs\LaravelConfig\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(string $name, $default = null)
 * @method static \Illuminate\Support\Collection getNested(string $namespace)
 * @method static \Illuminate\Support\Collection|null getByTag($tags)
 * @method static mixed set(string $name, $value)
 * @method static bool has(string $name)
 * @method static mixed all()
 * @method static bool create(\TarfinLabs\LaravelConfig\Config\ConfigItem $configItem)
 * @method static mixed update(\TarfinLabs\LaravelConfig\Config\Config $config, \TarfinLabs\LaravelConfig\Config\ConfigItem $configItem)
 * @method static int delete(\TarfinLabs\LaravelConfig\Config\Config $config)
 *
 * @see \TarfinLabs\LaravelConfig\ConfigManager
 */
class LaravelConfig extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-config';
    }
}
