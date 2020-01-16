<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class LaravelConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            /*
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-config.php'),
            ], 'config');
            */

            $this->publishes([
                __DIR__ . '/../database/migrations/2020_01_14_152443_create_config_table.php.stub' => database_path('migrations/2020_01_14_152443_create_config_table.php')
            ], 'migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-config');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-config', function () {
            return new LaravelConfig;
        });

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../src/factories');
    }

    public function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(Factory::class)->load($path);
    }
}
