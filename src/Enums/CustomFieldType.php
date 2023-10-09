<?php

namespace Yaangvu\LaravelCustomField\Enums;

use Yaangvu\LaravelCustomField\Traits\EnumToArray;

enum CustomFieldType: string
{
    use EnumToArray;

    case CHECKBOX = 'checkbox';
    case INT      = 'int';
    case NUMBER   = 'number';
    case RADIO    = 'radio';
    case SELECT   = 'select';
    case STRING   = 'string';
    case TEXT     = 'text';
    case DATETIME = 'datetime';
    case ARRAY    = 'array';
    case OBJECT   = 'object';
    case BOOLEAN  = 'boolean';
}