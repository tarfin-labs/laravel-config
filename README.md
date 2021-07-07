![Laravel Config Logo](https://s3-eu-west-1.amazonaws.com/media.tarfin.com/assets/logo-config.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/tarfin-labs/laravel-config/tests?label=tests)
[![Quality Score](https://img.shields.io/scrutinizer/g/tarfin-labs/laravel-config.svg?style=flat-square)](https://scrutinizer-ci.com/g/tarfin-labs/laravel-config)
[![Total Downloads](https://img.shields.io/packagist/dt/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)

## Introduction

Laravel config provides a simple configuration system for your Laravel application. 

## Installation

You can install the package via composer:

```bash
composer require tarfin-labs/laravel-config
```
Next, you should publish the Laravel config migration file using the vendor:publish Artisan command.

```
php artisan vendor:publish --provider="TarfinLabs\LaravelConfig\LaravelConfigServiceProvider" --tag="laravel-config"
```

If you want to use Laravel Config database factory, you can publish it too, using the command:

```
php artisan vendor:publish --provider="TarfinLabs\LaravelConfig\LaravelConfigServiceProvider" --tag="laravel-config-factories"
```

Finally, you should run your database migrations:

```
php artisan migrate
```

## Documentation

Simple usage example of laravel-config package in your Laravel app.

Create new config parameter:

``` php
$factory = new ConfigFactory();
$configItem = $factory->setName('key')
    ->setType('boolean')
    ->setValue('1')
    ->setTags(['system'])//optional
    ->setDescription('Lorem ipsum dolor sit amet')
    ->get();

LaravelConfig::create($configItem);
```

Get value with config name:

``` php
LaravelConfig::get('key');
```
Set value with config name and value:

``` php
LaravelConfig::set('key', 'value');
```

Get all config parameters:

``` php
LaravelConfig::all();
```

Get config items by tag:

``` php
LaravelConfig::getByTag('key');
```

Check if the config exists:

``` php
LaravelConfig::has('key');
```

Update config with new values:

``` php
$factory = new ConfigFactory($configId);
$configItem = $factory->setName('updated-key')
    ->setType('boolean')
    ->setValue('0')
    ->setTags(['system'])//optional
    ->setDescription('updated description')
    ->get();

LaravelConfig::update($configItem);
```

Remove config:

``` php
LaravelConfig::delete('key');
```

### Nested Parameters

Let's say you have a config parameters named `foo.bar` and `foo.baz`. You can get all parameters under `foo` namespace using `getNested()` method.

#### Usage:

```php
LaravelConfig::getNested('foo');
```

#### Output: `Illuminate\Support\Collection`
```php
=> Illuminate\Support\Collection {#3048
     all: [
       TarfinLabs\LaravelConfig\Config\Config {#3097
         id: 1,
         name: "bar",
         type: "boolean",
         val: "0",
         description: null,
         created_at: "2021-05-06 11:35:05",
         updated_at: "2021-05-06 11:35:05",
       },
       TarfinLabs\LaravelConfig\Config\Config {#3099
         id: 2,
         name: "baz",
         type: "boolean",
         val: "1",
         description: null,
         created_at: "2021-05-06 11:03:48",
         updated_at: "2021-05-06 11:03:48",
       },
     ],
   }
```

### Helpers
You can also use helper functions:

``` php
// Creating config item
$factory = new ConfigFactory();
$configItem = $factory->setName('key')
    ->setType('boolean')
    ->setValue('1')
    ->setTags(['system'])//optional
    ->setDescription('Lorem ipsum dolor sit amet')
    ->get();

create_config($configItem);

// Reading config item
read_config('key');

// Checking if the config item exists
has_config('key');

// Shortcut to update the value of config item
set_config_value('key', 'value');

// Updating config item
$factory = new ConfigFactory($configId);
$configItem = $factory->setName('updated-key')
    ->setType('boolean')
    ->setTags(['system'])//optional
    ->setValue('0')
    ->setDescription('updated description')
    ->get();

update_config($configItem);

// Removing config item
delete_config('key');

// Reading nested config items
read_nested('foo.bar');
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

### Security

If you discover any security related issues, please email development@tarfin.com instead of using the issue tracker.

## Credits

- [Turan Karatuğ](https://github.com/tkaratug)
- [Faruk Can](https://github.com/frkcn)
- [Yunus Emre Deligöz](https://github.com/deligoez)
- [Hakan Özdemir](https://github.com/hozdemir)
- [All Contributors](../../contributors)

## License

Laravel config is open-sourced software licensed under the [MIT license](LICENSE.md).
