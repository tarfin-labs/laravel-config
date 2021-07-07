<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;
use TarfinLabs\LaravelConfig\Config\Config;

/* @var $factory Factory */

$factory->define(Config::class, function (Faker $faker, array $attributes = []) {
    return [
        'name'        => $attributes['name'] ?? $faker->word().$faker->asciify('*****'),
        'type'        => $attributes['type'] ?? $faker->randomElement(['boolean', 'text']),
        'val'         => $attributes['val'] ?? $faker->word(),
        'description' => $faker->realText('50'),
        'tags'        => $attributes['tags'] ?? [$faker->randomElement(['admin','blog', 'global'])],
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
    ];
});
