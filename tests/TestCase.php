<?php

namespace TarfinLabs\LaravelConfig\Tests;

use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelConfigServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../src/database/migrations/2020_01_14_152443_create_config_table.php';

        (new \CreateConfigTable)->up();
    }
}
