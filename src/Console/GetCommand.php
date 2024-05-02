<?php

namespace TarfinLabs\LaravelConfig\Console;

use Illuminate\Console\Command;
use TarfinLabs\LaravelConfig\LaravelConfigFacade as LaravelConfig;

class GetCommand extends Command
{
    protected $signature = 'laravel-config:get 
                            {key        : Key }';

    protected $description = 'Get a key from the database and dump it to stdout';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $value = LaravelConfig::get_config($this->argument('key'));
        $this->line($value);
    }
}
