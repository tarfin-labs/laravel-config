<?php

namespace TarfinLabs\LaravelConfig\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TarfinLabs\LaravelConfig\Config\Config;

class ConfigFactory extends Factory
{
    protected $model = Config::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word().$this->faker->asciify('*****'),
            'type' => $this->faker->randomElement(['boolean', 'text']),
            'val' => $this->faker->word(),
            'description' => $this->faker->realText(50),
            'tags' => [$this->faker->randomElement(['admin', 'blog', 'global'])],
        ];
    }
}
