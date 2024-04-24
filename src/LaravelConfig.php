<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Support\Collection;
use TarfinLabs\LaravelConfig\Config\ConfigItem;
use TarfinLabs\LaravelConfig\LaravelConfigFacade as ConfigFacade;

class LaravelConfig
{
    /**
     * Get config by given name.
     *
     * @param  string  $name
     * @param  $default
     * @return mixed
     */
    public function get(string $name, $default = null): mixed
    {
        if (! $this->has($name)) {
            return $default;
        }

        return ConfigFacade::get($name);
    }

    /**
     * Get nested config params.
     *
     * @param  string  $namespace
     * @return Collection
     */
    public function getNested(string $namespace): Collection
    {
        return ConfigFacade::getNested($namespace);
    }

    /**
     * @param  $tags
     * @return Collection
     */
    public function getByTag($tags): Collection|null
    {
        if (! is_array($tags)) {
            $tags = [$tags];
        }

        return ConfigFacade::getByTag($tags);
    }

    /**
     * Set config with given data.
     *
     * @param  string  $name
     * @param  $value
     * @return mixed
     */
    public function set(string $name, $value): mixed
    {
        if (! $this->has($name)) {
            return null;
        }

        return ConfigFacade::set($name, $value);
    }

    /**
     * Check whether a config parameter is set.
     *
     * @param  string  $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return ConfigFacade::has($name);
    }

    /**
     * Get all config paremeters.
     *
     * @return mixed
     */
    public function all(): mixed
    {
        return ConfigFacade::all();
    }

    /**
     * Create a new config parameter.
     *
     * @param  ConfigItem  $configItem
     * @return bool
     */
    public function create(ConfigItem $configItem): bool
    {
        if ($this->has($configItem->name)) {
            return false;
        }

        return ConfigFacade::create($configItem);
    }

    /**
     * Update config paremeter.
     *
     * @param  Config  $config
     * @param  ConfigItem  $configItem
     * @return mixed
     */
    public function update($config, ConfigItem $configItem): mixed
    {
        return ConfigFacade::update_config($configItem);
    }

    /**
     * Delete config parameter.
     *
     * @param  $config
     * @return int
     */
    public function delete($config): int
    {
        return ConfigFacade::delete_config($config);
    }
}
