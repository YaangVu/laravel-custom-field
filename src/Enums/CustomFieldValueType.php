<?php

namespace Yaangvu\LaravelCustomField\Enums;

use Yaangvu\LaravelCustomField\Traits\EnumToArray;

enum CustomFieldValueType: string
{
    use EnumToArray;

    case BOOLEAN  = 'value_boolean';
    case INT      = 'value_int';
    case NUMBER   = 'value_number';
    case STRING   = 'value_string';
    case TEXT     = 'value_text';
    case JSON     = 'value_json';
    case DATETIME = 'value_datetime';
}