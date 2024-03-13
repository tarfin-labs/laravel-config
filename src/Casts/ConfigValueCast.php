<?php

namespace TarfinLabs\LaravelConfig\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelConfig\Enums\ConfigDataType;

class ConfigValueCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
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

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return $value;

        $type = $attributes['type']?->value ?? $attributes['type'] ?? null;

        switch ($type) {
            case ConfigDataType::DATE->value:
                return Carbon::parse($value)->format('Y-m-d');
            case ConfigDataType::DATE_TIME->value:
                return Carbon::parse($value)->format('Y-m-d H:i');
            case ConfigDataType::JSON->value:
                return json_encode($value, true);
            default:
                return $value;
        }
    }
}
