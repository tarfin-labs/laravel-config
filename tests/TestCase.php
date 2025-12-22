<?php

namespace TarfinLabs\LaravelConfig\Tests;

use Illuminate\Support\Facades\Schema;
use TarfinLabs\LaravelConfig\LaravelConfigServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Schema::dropAllTables();

        $this->artisan('migrate', [
            '--realpath' => realpath(__DIR__.'/../database/migrations'),
        ]);
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
