<?php

namespace TarfinLabs\LaravelConfig\Config;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $guarded = [];

    protected $fillable = ['name', 'val', 'type', 'description', 'tags'];
}
