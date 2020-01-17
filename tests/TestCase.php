<?php

namespace TarfinLabs\LaravelConfig\Tests;

use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');
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
        include_once __DIR__.'/../database/migrations/create_config_table.php.stub';

        (new \CreateLaravelConfigTable)->up();
    }
}
