<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use TarfinLabs\LaravelConfig\Casters\BooleanCaster;
use TarfinLabs\LaravelConfig\Casters\DateCaster;
use TarfinLabs\LaravelConfig\Casters\IntegerCaster;
use TarfinLabs\LaravelConfig\Casters\JsonCaster;
use TarfinLabs\LaravelConfig\Config\Config;
use TarfinLabs\LaravelConfig\Config\ConfigItem;

class LaravelConfig
{
    private array $casters = [
        'boolean' => BooleanCaster::class,
        'date' => DateCaster::class,
        'integer' => IntegerCaster::class,
        'json' => JsonCaster::class,
    ];

    /**
     * Get config by given name.
     *
     * @param  string  $name
     * @param  $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        if (! $this->has($name)) {
            return $default;
        }

        $config = Config::where('name', $name)->first();

        $type = $config->type;

        if (array_key_exists($type, $this->casters)) {
            $caster = new $this->casters[$type];
            return $caster->cast($config->val);
        }

        return $config->val;
    }

    /**
     * Get nested config params.
     *
     * @param  string  $namespace
     * @return Collection
     */
    public function getNested(string $namespace): Collection
    {
        $params = Config::where('name', 'LIKE', "{$namespace}.%")->get();

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
    public function getByTag($tags): ?Collection
    {
        if (! is_array($tags)) {
            $tags = [$tags];
        }

        return Config::whereJsonContains('tags', $tags)->get();
    }

    /**
     * Set config with given data.
     *
     * @param  string  $name
     * @param  $value
     * @return mixed
     */
    public function set(string $name, $value)
    {
        if (! $this->has($name)) {
            return;
        }

        $config = Config::where('name', $name)->first();

        $config->val = $value;
        $config->save();

        return $value;
    }

    /**
     * Check whether a config parameter is set.
     *
     * @param  string  $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return Config::where('name', $name)->count() > 0;
    }

    /**
     * Get all config paremeters.
     *
     * @return mixed
     */
    public function all()
    {
        return Config::all();
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

        $config = new Config();

        return $this->fillColumns($config, $configItem)->save();
    }

    /**
     * Update config paremeter.
     *
     * @param  Config  $config
     * @param  ConfigItem  $configItem
     * @return mixed
     */
    public function update(Config $config, ConfigItem $configItem)
    {
        return $this->fillColumns($config, $configItem)->save();
    }

    /**
     * Delete config parameter.
     *
     * @param  Config  $config
     * @return int
     */
    public function delete(Config $config): int
    {
        return Config::destroy($config->id);
    }

    /**
     * Fill config paremeter columns.
     *
     * @param  Config  $config
     * @param  ConfigItem  $configItem
     * @return Config
     */
    private function fillColumns(Config $config, ConfigItem $configItem): Config
    {
        $config->name = $configItem->name;
        $config->val = $configItem->val;
        $config->type = $configItem->type;
        $config->description = $configItem->description;
        $config->tags = $configItem->tags;

        return $config;
    }
}
