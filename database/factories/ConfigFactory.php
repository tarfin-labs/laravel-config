<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factory;
use TarfinLabs\LaravelConfig\Config\Config;

/* @var $factory Factory */

$factory->define(Config::class, function (Faker $faker, array $attributes = []) {
    return [
        'name'        => $attributes['name'] ?? $faker->word(),
        'type'        => $attributes['type'] ?? $faker->randomElement(['boolean', 'text']),
        'val'         => $attributes['val'] ?? $faker->word(),
        'description' => $faker->realText('50'),
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
    ];
});
