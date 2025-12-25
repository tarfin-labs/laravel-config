![Laravel Config Logo](https://s3-eu-west-1.amazonaws.com/media.tarfin.com/assets/logo-config.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tarfin-labs/laravel-config/tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/tarfin-labs/laravel-config/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tarfin-labs/laravel-config.svg?style=flat-square)](https://packagist.org/packages/tarfin-labs/laravel-config)

## Introduction

Laravel Config provides a database-backed configuration management system for your Laravel application. Store, retrieve, and manage configuration parameters with automatic type casting, tagging support, and nested namespaces.

**Key Features:**
- Database-backed configuration storage
- Automatic type casting (boolean, integer, date, datetime, JSON, custom casters)
- Tag-based organization and retrieval
- Nested namespace support (e.g., `app.mail.host`)
- Facade and helper function access
- Laravel 10, 11, and 12 support

## Version Compatibility

### v6.x (Latest)

| Requirement | Versions |
|-------------|----------|
| PHP | 8.1, 8.2, 8.3, 8.4, 8.5 |
| Laravel | 10, 11, 12 |
| PHPUnit | 10, 11, 12 |

### v5.x (Maintenance)

| Requirement | Versions |
|-------------|----------|
| PHP | 8.1, 8.2, 8.3, 8.4, 8.5 |
| Laravel | 10, 11, 12 |
| PHPUnit | 9.5, 10, 11, 12 |

## Installation

Install the package via Composer:

```bash
composer require tarfin-labs/laravel-config
```

Publish the configuration and migration files:

```bash
php artisan vendor:publish --provider="TarfinLabs\LaravelConfig\LaravelConfigServiceProvider" --tag="laravel-config"
```

Run the migrations:

```bash
php artisan migrate
```

## Quick Start

```php
use TarfinLabs\LaravelConfig\Facades\LaravelConfig;
use TarfinLabs\LaravelConfig\Config\ConfigFactory;
use TarfinLabs\LaravelConfig\Enums\ConfigDataType;

// Create a config parameter
$configItem = (new ConfigFactory())
    ->setName('app.debug')
    ->setType(ConfigDataType::BOOLEAN)
    ->setValue(true)
    ->get();

LaravelConfig::create($configItem);

// Get a config value
$debug = LaravelConfig::get('app.debug'); // returns true (boolean)

// Update a config value
LaravelConfig::set('app.debug', false);

// Check if config exists
if (LaravelConfig::has('app.debug')) {
    // ...
}
```

## Usage

### Using the Facade

```php
use TarfinLabs\LaravelConfig\Facades\LaravelConfig;

// Get a single config value
LaravelConfig::get('key');
LaravelConfig::get('key', 'default'); // with default value

// Set a config value
LaravelConfig::set('key', 'value');

// Check existence
LaravelConfig::has('key');

// Get all configs
LaravelConfig::all();
```

### Creating Config Parameters

Use `ConfigFactory` to build configuration items:

```php
use TarfinLabs\LaravelConfig\Config\ConfigFactory;
use TarfinLabs\LaravelConfig\Enums\ConfigDataType;

$configItem = (new ConfigFactory())
    ->setName('mail.host')
    ->setType(ConfigDataType::STRING)
    ->setValue('smtp.example.com')
    ->setDescription('SMTP server hostname')
    ->setTags(['mail', 'system'])
    ->get();

LaravelConfig::create($configItem);
```

### Supported Data Types

The `ConfigDataType` enum provides the following types with automatic casting:

| Type | Storage | Retrieved As |
|------|---------|--------------|
| `BOOLEAN` | `'1'` or `'0'` | `true` or `false` |
| `INTEGER` | `'123'` | `123` |
| `DATE` | `'2024-12-25'` | Carbon instance |
| `DATE_TIME` | `'2024-12-25 14:30'` | Carbon instance |
| `JSON` | JSON string | Array |

**Custom Casters:**

You can use Laravel's custom cast classes:

```php
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;

$configItem = (new ConfigFactory())
    ->setName('allowed.statuses')
    ->setType(AsEnumCollection::class . ':' . StatusEnum::class)
    ->setValue([StatusEnum::Active, StatusEnum::Pending])
    ->get();
```

### Working with Tags

Organize configs with tags and retrieve them by tag:

```php
// Create configs with tags
$dbHost = (new ConfigFactory())
    ->setName('db.host')
    ->setValue('localhost')
    ->setTags(['database', 'connection'])
    ->get();

$dbPort = (new ConfigFactory())
    ->setName('db.port')
    ->setValue('3306')
    ->setTags(['database', 'connection'])
    ->get();

LaravelConfig::create($dbHost);
LaravelConfig::create($dbPort);

// Get all configs with a specific tag
$databaseConfigs = LaravelConfig::getByTag('database');

// Get configs matching multiple tags
$connectionConfigs = LaravelConfig::getByTag(['database', 'connection']);
```

### Nested Parameters

Group related configs using dot notation and retrieve them by namespace:

```php
// Create nested configs
LaravelConfig::create((new ConfigFactory())->setName('mail.host')->setValue('smtp.example.com')->get());
LaravelConfig::create((new ConfigFactory())->setName('mail.port')->setValue('587')->get());
LaravelConfig::create((new ConfigFactory())->setName('mail.encryption')->setValue('tls')->get());

// Get all configs under 'mail' namespace
$mailConfigs = LaravelConfig::getNested('mail');

// Returns a Collection with normalized names:
// [
//     ConfigItem { name: 'host', val: 'smtp.example.com' },
//     ConfigItem { name: 'port', val: '587' },
//     ConfigItem { name: 'encryption', val: 'tls' },
// ]
```

### Updating and Deleting

```php
use TarfinLabs\LaravelConfig\Config\Config;

// Update using set() for simple value changes
LaravelConfig::set('app.name', 'New App Name');

// Full update with ConfigFactory
$config = Config::where('name', 'app.name')->first();
$configItem = (new ConfigFactory($config))
    ->setValue('Updated Name')
    ->setDescription('Updated description')
    ->get();

LaravelConfig::update($config, $configItem);

// Delete a config
$config = Config::where('name', 'obsolete.config')->first();
LaravelConfig::delete($config);
```

## Helper Functions

All facade methods are available as helper functions:

```php
// Create
create_config($configItem);

// Read
read_config('key');           // Get single value
read_config();                // Get all configs

// Check existence
has_config('key');

// Update
set_config_value('key', 'new value');  // Quick value update
update_config($config, $configItem);    // Full update

// Delete
delete_config($config);

// Nested
read_nested('mail');  // Get all configs under 'mail' namespace
```

## Database Schema

The package creates a `laravel_config` table with the following structure:

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `name` | varchar (unique) | Configuration parameter name |
| `type` | varchar | Data type (default: 'boolean') |
| `val` | varchar (nullable) | Configuration value |
| `description` | text (nullable) | Human-readable description |
| `tags` | json (nullable) | Array of tags for organization |
| `created_at` | timestamp | Creation timestamp |
| `updated_at` | timestamp | Last update timestamp |

## Configuration

Publish the config file to customize the table name:

```bash
php artisan vendor:publish --provider="TarfinLabs\LaravelConfig\LaravelConfigServiceProvider" --tag="laravel-config"
```

In `config/laravel-config.php`:

```php
return [
    'table' => env('LARAVEL_CONFIG_TABLE', 'laravel_config'),
];
```

## Upgrading

### From v5.x to v6.x

**Breaking Changes:**

1. **Class Renamed**: `LaravelConfig` class is now `ConfigManager`
2. **Facade Moved**: `LaravelConfigFacade` is now `Facades\LaravelConfig`
3. **Version Support**: PHP 8.0 and Laravel 8-9 are no longer supported

**Migration Guide:**

If you were directly instantiating the class:

```php
// Before (v5.x)
use TarfinLabs\LaravelConfig\LaravelConfig;
$manager = new LaravelConfig();

// After (v6.x)
use TarfinLabs\LaravelConfig\ConfigManager;
$manager = new ConfigManager();
```

If you were importing the facade directly:

```php
// Before (v5.x)
use TarfinLabs\LaravelConfig\LaravelConfigFacade;

// After (v6.x)
use TarfinLabs\LaravelConfig\Facades\LaravelConfig;
```

**No changes required if you:**
- Use the `LaravelConfig` facade alias
- Use helper functions (`read_config()`, `set_config_value()`, etc.)
- Use `app('laravel-config')` container binding

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Security

If you discover any security-related issues, please email development@tarfin.com instead of using the issue tracker.

## Credits

- [Turan Karatug](https://github.com/tkaratug)
- [Faruk Can](https://github.com/frkcn)
- [Yunus Emre Deligoz](https://github.com/deligoez)
- [Hakan Ozdemir](https://github.com/hozdemir)
- [All Contributors](../../contributors)

## License

Laravel Config is open-sourced software licensed under the [MIT license](LICENSE.md).
