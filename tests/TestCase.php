<?php

namespace TarfinLabs\LaravelConfig\Tests;

// use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Schema::dropAllTables();

        // $this->artisan('migrate', [
        //     '--database' => 'mysql',
        //     '--realpath' => realpath(__DIR__.'/../database/migrations'),
        // ]);
        $this->artisan('laravel-config:install');
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelConfigServiceProvider::class,
        ];
    }
}
