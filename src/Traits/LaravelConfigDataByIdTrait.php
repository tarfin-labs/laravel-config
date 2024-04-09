<?php

namespace App\Traits;

trait LaravelConfigDataByIdTrait
{
    /**
     * Set config with given data by id.
     *
     * @param  int  $id
     * @param  mixed  $value
     * @return mixed
     */
    public function set_by_id(int $id, mixed $value): mixed
    {
        $config = parent::where('id', $id)->first();

        if ($config === null) {
            return null;
        }

        $config->val = $value;
        $config->save();

        return $value;
    }

    /**
     * Set config discription with given data by id.
     *
     * @param  int  $id
     * @param  string  $value
     * @return string|null
     */
    public function set_discription_by_id(int $id, string $value): string|null
    {
        $config = parent::where('id', $id)->first();

        if ($config === null) {
            return null;
        }

        $config->description = $value;
        $config->save();

        return $value;
    }

    /**
     * Set config description with given data by id.
     *
     * @param  int  $id
     * @param  mixed  $value
     * @return array|null
     */
    public function set_tags_by_id(int $id, mixed $value): mixed
    {
        $config = parent::where('id', $id)->first();

        if ($config === null) {
            return null;
        }

        $config->tags = $value;
        $config->save();

        return $value;
    }

    /**
     * Get config by given id.
     *
     * @param  int  $id
     * @param  mixed  $default
     * @return mixed
     */
    public function get_by_id(int $id, mixed $default = null): mixed
    {
        $config = parent::where('id', $id)->first();

        if ($config === null) {
            return $default;
        }

        return $config;
    }
}
