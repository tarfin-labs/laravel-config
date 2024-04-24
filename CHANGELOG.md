# Changelog
All notable changes to `laravel-config` will be documented in this file.

## [Unreleased] - 2024-04-09

- ### Braking Change: Made the Models and Traits Publishable, so you can add SoftDeletes, auditing, and/or caching if you want (YOU MUST RUN THE INSTALLATION COMMAND)
- ### Braking Change: Check your Namespaces 
- Moved the config functions to a Trait so adding functions is as simple as editing the published Trait or adding another Trait
- I left the original `LaravelConfig` class as an alies of the Model, but it needs more testing
- ### Braking Change: The Update function needed to be renamed from `update` to `update_config`
- ### Braking Change: The Update function Only takes one parameter just the `ConfigItem`
- ### Braking Change: The `update_config` helper Only takes one parameter just the `ConfigItem`
- ### Braking Change: The Delete function needed to be renamed from `delete` to `delete_config`
- Because of the Braking Changes I also added a `get_config`, `set_config`, `has_config`, and `create_config` aliases for consistency
- NON Braking Change: Removed the `all` function as it's not needed anymore since it's a function of a Model
- I'm adding more functions to another Trait that can be added by including it in the Model these are all traits that I've found useful
- Added comands to `get_config` and `set_config` from the console
- Added more datatypes


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
