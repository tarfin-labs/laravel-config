<?php

use App\Models\Config as ConfigModel;
use TarfinLabs\LaravelConfig\Config\ConfigItem;

if (! function_exists('create_config')) {
    /**
     * Create a config item.
     *
     * @param  ConfigItem  $configItem
     * @return mixed
     */
    function create_config(ConfigItem $configItem): mixed
    {
        return app('laravel-config')->create($configItem);
    }
}

if (! function_exists('read_config')) {
    /**
     * Read a config item by given name.
     *
     * @param  string|null  $key
     * @return mixed
     */
    function read_config(string|null $key = null): mixed
    {
        if ($key === null) {
            return app('laravel-config')->all();
        }

        return app('laravel-config')->get($key);
    }
}

if (! function_exists('read_nested')) {
    /**
     * Read nested config items by given namespace.
     *
     * @param  string|null  $key
     * @return mixed
     */
    function read_nested(string $key): mixed
    {
        return app('laravel-config')->getNested($key);
    }
}

if (! function_exists('update_config')) {
    /**
     * Update given config item by given data.
     *
     * @param  ConfigItem  $configItem
     * @return mixed
     */
    function update_config(ConfigItem $configItem): mixed
    {
        return app('laravel-config')->update_config($configItem);
    }
}

if (! function_exists('delete_config')) {
    /**
     * Delete given config item.
     *
     * @param  ConfigModel  $config
     * @return mixed
     */
    function delete_config(ConfigModel $config): mixed
    {
        return app('laravel-config')->delete_config($config);
    }
}

if (! function_exists('set_config_value')) {
    /**
     * Shortcut to update the value of a config item by given name and value.
     *
     * @param  string  $key
     * @param  $value
     * @return mixed
     */
    function set_config_value(string $key, $value): mixed
    {
        return app('laravel-config')->set($key, $value);
    }
}

if (! function_exists('has_config')) {
    /**
     * Check whether a config item exists by given name.
     *
     * @param  string  $key
     * @return bool
     */
    function has_config(string $key): bool
    {
        return app('laravel-config')->has($key);
    }
}
