<?php

namespace Yaangvu\LaravelCustomField\Enums;

enum CustomFieldValueType: string
{
    case BOOLEAN = 'value_boolean';
    case INT = 'value_int';
    case NUMBER = 'value_number';
    case STRING = 'value_string';
    case TEXT = 'value_text';
    case JSON = 'value_json';
    case DATETIME = 'value_datetime';
}