<?php

namespace TarfinLabs\LaravelConfig\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TarfinLabs\LaravelConfig\Casts\ConfigValueCast;
use TarfinLabs\LaravelConfig\Database\Factories\ConfigFactory;

class Config extends Model
{
    use HasFactory;
    protected $table = 'config';

    protected $guarded = [];

    protected $fillable = ['name', 'val', 'type', 'description', 'tags'];

    protected $casts = [
        'tags' => 'array',
        'val' => ConfigValueCast::class,
    ];

    public function __construct($attributes = [])
    {
        $this->setTable(config('laravel-config.table'));
        parent::__construct($attributes);
    }

    protected static function newFactory(): ConfigFactory
    {
        return ConfigFactory::new();
    }
}
