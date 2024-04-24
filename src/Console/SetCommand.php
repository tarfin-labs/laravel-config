<?php

namespace TarfinLabs\LaravelConfig\Console;

use Illuminate\Console\Command;
use TarfinLabs\LaravelConfig\LaravelConfigFacade as LaravelConfig;

class SetCommand extends Command
{
    protected $signature = 'laravel-config:set 
                            {key        : Key }
                            {value      : A string value }';

    protected $description = 'Save a key to the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        LaravelConfig::set_config($this->argument('key'), $this->argument('value'));
    }
}
