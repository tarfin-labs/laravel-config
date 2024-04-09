<?php

namespace TarfinLabs\LaravelConfig\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-config:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel-config Models, Factories, and Traits.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Models...
        (new Filesystem)->ensureDirectoryExists(app_path('Models/'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Models', app_path('Models/'));

        // Traits...
        (new Filesystem)->ensureDirectoryExists(app_path('Traits/'));
        (new Filesystem)->copyDirectory(__DIR__.'/../Traits', app_path('Traits/'));

        // Factory...
        (new Filesystem)->ensureDirectoryExists(database_path('factories/'));
        (new Filesystem)->copy(__DIR__.'/../../database/factories/ConfigFactory.php', database_path('factories/ConfigFactory.php'));

        $this->info('Laravel-config installed successfully.');
    }

}
