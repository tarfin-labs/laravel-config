<?php

namespace TarfinLabs\LaravelConfig\Enums;

enum ConfigDataType: string
{
    case STRING = 'string';
    case NUMERIC = 'numeric';
    case NONE = 'None';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case JSON = 'json';
    case DATE = 'date';
    case DATE_TIME = 'datetime';
}
