<?php

namespace TarfinLabs\LaravelConfig;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TarfinLabs\LaravelConfig\Skeleton\SkeletonClass
 */
class LaravelConfigFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-config';
    }
}
