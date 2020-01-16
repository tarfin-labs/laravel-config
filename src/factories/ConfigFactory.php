<?php

namespace TarfinLabs\LaravelConfig\Factories;

use Faker\Generator as Faker;
use TarfinLabs\LaravelConfig\Config\Config;

$factory->define(Config::class, function (Faker $faker, array $attributes = []) {
    return [
        'name'  => isset($attributes['name']) ?: $faker->word(),
        'type' => isset($attributes['type']) ?: $faker->randomElement(['boolean', 'text']),
        'val' => isset($attributes['val']) ?: $faker->word(),
        'description' => $faker->realText('50'),
        'created_at' => '2020-01-01 10:00:00',
        'updated_at' => '2020-01-01 10:00:00',
    ];
});
