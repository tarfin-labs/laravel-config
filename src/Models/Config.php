<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LaravelConfigTrait;
use TarfinLabs\LaravelConfig\Casts\ConfigValueCast;

class Config extends Model
{
    use LaravelConfigTrait;

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
}
