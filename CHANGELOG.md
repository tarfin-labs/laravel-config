# Changelog
All notable changes to `laravel-config` will be documented in this file.

## [Unreleased]

## [6.0.0] - 2025-12-22

### Breaking Changes
- Renamed `LaravelConfig` class to `ConfigManager` to prevent confusion with the facade.
- Moved `LaravelConfigFacade` to `Facades/LaravelConfig` following Laravel convention.

### Changed
- Facade is now located at `TarfinLabs\LaravelConfig\Facades\LaravelConfig`.
- The facade no longer uses the `Facade` suffix, following Laravel's naming convention.
- Added proper `@method` docblocks to the facade for better IDE autocompletion.

### Migration Guide
If you were directly importing the `LaravelConfig` class:
```php
// Before
use TarfinLabs\LaravelConfig\LaravelConfig;
$config = new LaravelConfig();

// After
use TarfinLabs\LaravelConfig\ConfigManager;
$config = new ConfigManager();
```

If you were using the facade or helper functions, no changes are required.

## [5.2.0] - 2025-02-21
- Laravel 12 and PHP 8.4 support added.

## [5.1.0] - 2024-04-08

- Laravel 11 and PHP 8.3 support added.

## [5.0.0] - 2024-03-05

- Dropped support for PHP versions below 8.1.
- Added dynamic casting support to the LaravelConfig class, enabling it to cast configuration values based on their types.
- Added new enum `ConfigValueCast.php`

## [4.7.0] - 2023-05-11

- PHP 8.2 support added.

## [4.6.0] - 2023-02-16

- Laravel 10 support added.

## [4.5.0] - 2022-02-08

- Laravel 9 support added.

## [4.4.0] - 2021-07-08

- Config publish enabled

## [4.3.0] - 2021-07-08

- db migrations are now automatically discover.
- now table name can be set from config.

## [4.2.0] - 2021-07-07

- Tags feature added.

## [4.1.0] - 2021-06-03

- PHP 8 support added.

## [4.0.0] - 2021-05-06

- 2021-05-06: `getNested()` method added for getting nested config params.
- 2021-05-07: Dropped support for php 7.2, 7.3 and Laravel 6.x, 7.x

## [3.0.0] - 2020-10-06

- 2020-10-06: Laravel config now compatible with Laravel 8.

## [2.0.0] - 2020-03-04

- 2020-01-17: Generate unique names on `ConfigFactory`
- 2020-03-04: Laravel config now compatible with Laravel 7.
- 2020-03-04: Helpers added

## [1.1.0] - 2020-01-17

- Add publishable Laravel `ConfigFactory` 

## [1.0.0] - 2020-01-16

- Initial Release
