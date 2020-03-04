<?php

use TarfinLabs\LaravelConfig\Config\Config;
use TarfinLabs\LaravelConfig\Config\ConfigItem;

if (! function_exists('create_config')) {
    /**
     * Create a config item.
     *
     * @param ConfigItem $configItem
     * @return mixed
     */
    function create_config(ConfigItem $configItem)
    {
        return app('laravel-config')->create($configItem);
    }
}

if (! function_exists('read_config')) {
    /**
     * Read a config item by given name.
     *
     * @param string|null $key
     * @return mixed
     */
    function read_config(string $key = null)
    {
        if (is_null($key)) {
            return app('laravel-config')->all();
        }

        return app('laravel-config')->get($key);
    }
}

if (! function_exists('update_config')) {
    /**
     * Update given config item by given data.
     *
     * @param Config $config
     * @param ConfigItem $configItem
     * @return mixed
     */
    function update_config(Config $config, ConfigItem $configItem)
    {
        return app('laravel-config')->update($config, $configItem);
    }
}

if (! function_exists('delete_config')) {
    /**
     * Delete given config item.
     *
     * @param Config $config
     * @return mixed
     */
    function delete_config(Config $config)
    {
        return app('laravel-config')->delete($config);
    }
}

if (! function_exists('set_config_value')) {
    /**
     * Shortcut to update the value of a config item by given name and value.
     *
     * @param string $key
     * @param $value
     * @return mixed
     */
    function set_config_value(string $key, $value)
    {
        return app('laravel-config')->set($key, $value);
    }
}

if (! function_exists('has_config')) {
    /**
     * Check whether a config item exists by given name.
     *
     * @param string $key
     * @return bool
     */
    function has_config(string $key)
    {
        return app('laravel-config')->has($key);
    }
}
