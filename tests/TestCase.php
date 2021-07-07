<?php

namespace TarfinLabs\LaravelConfig\Tests;

use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');

        include_once __DIR__.'/../database/migrations/create_laravel_config_table.php.stub';
        include_once __DIR__.'/../database/migrations/add_tags_column_to_config_table.php.stub';

        (new \CreateLaravelConfigTable)->down();
        (new \CreateLaravelConfigTable)->up();

        (new \AddTagsColumnToConfigTable)->down();
        (new \AddTagsColumnToConfigTable)->up();
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelConfigServiceProvider::class,
        ];
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
    }
}
