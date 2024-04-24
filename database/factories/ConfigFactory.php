<?php

use App\Models\Config as ConfigModel;
// use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/* @var $factory Factory */

$factory->define(ConfigModel::class, function (Faker $faker, array $attributes = []) {
    return [
        'name' => $attributes['name'] ?? $faker->word().$faker->asciify('*****'),
        'type' => $attributes['type'] ?? $faker->randomElement(['boolean', 'text']),
        'val' => $attributes['val'] ?? $faker->word(),
        'description' => $faker->realText('50'),
        'tags' => $attributes['tags'] ?? [$faker->randomElement(['admin', 'blog', 'global'])],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
