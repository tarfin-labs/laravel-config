<?php

namespace TarfinLabs\LaravelConfig\Config;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $guarded = [];

    protected $fillable = ['name', 'val', 'type', 'description', 'tags'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function __construct($attributes = [])
    {
        $this->setTable(config('laravel-config.table'));
        parent::__construct($attributes);
    }
}
