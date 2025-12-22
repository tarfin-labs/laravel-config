<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Support\ServiceProvider;

class LaravelConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-config.php'),
            ], 'laravel-config');

            $this->publishes([
                __DIR__.'/../database/factories/ConfigFactory.php' => database_path('factories/ConfigFactory.php'),
            ], 'laravel-config-factories');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-config');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-config', function () {
            return new ConfigManager;
        });
    }
}
