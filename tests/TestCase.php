<?php

namespace TarfinLabs\LaravelConfig\Tests;

use Illuminate\Support\Facades\Schema;
use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');

        $this->setUpDatabase($this->app);
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

    protected function setUpDatabase($app)
    {
        Schema::dropAllTables();

        include_once __DIR__.'/../database/migrations/create_laravel_config_table.php.stub';
        include_once __DIR__.'/../database/migrations/add_tags_column_to_config_table.php.stub';

        (new \CreateLaravelConfigTable)->up();
        (new \AddTagsColumnToConfigTable)->up();
    }
}
