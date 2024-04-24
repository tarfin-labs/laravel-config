<?php

namespace TarfinLabs\LaravelConfig\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use TarfinLabs\LaravelConfig\Enums\ConfigDataType;

class ConfigValueCast implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return TGet|null
     */
    public function get($model, string $key, mixed $value, array $attributes)
    {
        return match ($attributes['type']) {
            ConfigDataType::BOOLEAN->value => (bool) $value,
            ConfigDataType::INTEGER->value => (int) $value,
            ConfigDataType::DATE->value => Carbon::createFromFormat('Y-m-d', $value),
            ConfigDataType::DATE_TIME->value => Carbon::createFromFormat('Y-m-d H:i', $value),
            ConfigDataType::JSON->value => json_decode($value, true),
            default => $value,
        };
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  TSet|null  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, mixed $value, array $attributes)
    {
        return $value;
    }
}
