<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use TarfinLabs\LaravelConfig\Config\ConfigItem;

trait LaravelConfigTrait
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

        $config = parent::where('name', $name)->first();

        return $config->val;
    }

    /**
     * Get config by given name.
     * this is an alias of the get function
     * for consistency.
     *
     * @param  string  $name
     * @param  $default
     * @return mixed
     */
    public function get_config(string $name, $default = null): mixed
    {
        return $this->get($name, $default);
    }

    /**
     * Get nested config params.
     *
     * @param  string  $namespace
     * @return Collection
     */
    public function getNested(string $namespace): Collection
    {
        $params = parent::where('name', 'LIKE', "{$namespace}.%")->get();

        $config = collect();

        foreach ($params as $param) {
            $keys = explode('.', str_replace("{$namespace}.", '', $param->name));
            $name = '';

            foreach ($keys as $key) {
                $name .= $key.'.';
            }

            $param->name = rtrim($name, '.');

            $config->push($param);
        }

        return $config;
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

        return parent::whereJsonContains('tags', $tags)->get();
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

        $config = parent::where('name', $name)->first();

        $config->val = $value;
        $config->save();

        return $value;
    }

    /**
     * Set config with given data.
     * this is an alias of the set function
     * for consistency.
     *
     * @param  string  $name
     * @param  $value
     * @return mixed
     */
    public function set_config(string $name, $value): mixed
    {
        return $this->set($name, $value);
    }

    /**
     * Check whether a config parameter is set.
     *
     * @param  string  $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return parent::where('name', $name)->count() > 0;
    }

    /**
     * Check whether a config parameter is set.
     * this is an alias of the has function
     * for consistency.
     *
     * @param  string  $name
     * @return bool
     */
    public function has_config(string $name): bool
    {
        return $this->has($name);
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

        return $this->fillColumns($configItem)->save();
    }

    /**
     * Create a new config parameter.
     * this is an alias of the create function
     * for consistency.
     *
     * @param  ConfigItem  $configItem
     * @return bool
     */
    public function create_config(ConfigItem $configItem): bool
    {
        return $this->create($configItem);
    }

    /**
     * Update config paremeter.
     *
     * @param  ConfigItem  $configItem
     * @return mixed
     */
    public function update_config(ConfigItem $configItem): mixed
    {
        $config = parent::where('name', $configItem->name)->first();

        return $config->fillColumns($configItem)->save();
    }

    /**
     * Delete config parameter.
     *
     * @param  Config  $config
     * @return int
     */
    public function delete_config(parent $config): int
    {
        return parent::destroy($config->id);
    }

    /**
     * Fill config paremeter columns.
     *
     * @param  Config  $config
     * @param  ConfigItem  $configItem
     * @return parent
     */
    private function fillColumns(ConfigItem $configItem): parent
    {
        $this->name = $configItem->name;
        $this->val = $configItem->val;
        $this->type = $configItem->type;
        $this->description = $configItem->description;
        $this->tags = $configItem->tags;

        return $this;
    }
}
