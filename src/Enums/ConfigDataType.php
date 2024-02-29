<?php
namespace TarfinLabs\LaravelConfig\Enums;

enum ConfigDataType: string
{
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case JSON = 'json';
    case DATE = 'date';
    case DATE_TIME = 'datetime';
}
