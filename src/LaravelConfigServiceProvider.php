<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Support\ServiceProvider;
use App\Models\Config as ConfigModel;

class LaravelConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-config.php'),
            ], 'laravel-config');

            $this->publishes([
                __DIR__.'/../database/factories/ConfigFactory.php' => database_path('factories/ConfigFactory.php'),
            ], 'laravel-config-factories');
            $this->publishes([
                __DIR__.'/Traits' => app_path('Traits'),
                __DIR__.'/Models' => app_path('Models'),
            ], 'laravel-config-models');
            $this->commands([
                Console\InstallCommand::class,
            ]);
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
        $this->app->singleton('laravel-config', static function () {
            return new ConfigModel();
        });
    }
}
