# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/tarfin-labs/laravel-config/tests?label=tests)
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
