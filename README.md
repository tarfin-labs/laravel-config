# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)
[![Build Status](https://img.shields.io/travis/tarfin-labs/laravel-config/master.svg?style=flat-square)](https://travis-ci.org/tarfin-labs/laravel-config)
[![Quality Score](https://img.shields.io/scrutinizer/g/tarfin-labs/laravel-config.svg?style=flat-square)](https://scrutinizer-ci.com/g/tarfin-labs/laravel-config)
[![Total Downloads](https://img.shields.io/packagist/dt/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require tarfin-labs/laravel-config
```

## Usage

``` php
// Create new config parameter
$factory = new ConfigFactory();
$configItem = $factory->setName('key')
    ->setType('boolean')
    ->setValue('1')
    ->setDescription('Lorem ipsum dolor sit amet')
    ->get();

LaravelConfig::create($configItem);

// Get the value of given config paramter
LaravelConfig::get('key');

// Set a value to given config parameter
LaravelConfig::set('key', 'value');

// Get all config parameters
LaravelConfig::all();

// Check if the config parameter is exist
LaravelConfig::has('key');

// Update a config parameter record
$factory = new ConfigFactory($configId);
$configItem = $factory->setName('updated-key')
    ->setType('boolean')
    ->setValue('0')
    ->setDescription('updated description')
    ->get();

LaravelConfig::update($configItem);

// Remove given config parameter
LaravelConfig::delete('key');
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tkaratug@hotmail.com.tr instead of using the issue tracker.

## Credits

- [Turan Karatuğ](https://github.com/tarfin-labs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
