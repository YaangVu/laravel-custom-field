<?php

namespace Yaangvu\LaravelCustomField\Enums;

enum CustomFieldType: string
{
    case CHECKBOX = 'checkbox';
    case INT = 'int';
    case NUMBER = 'number';
    case RADIO = 'radio';
    case SELECT = 'select';
    case STRING = 'string';
    case TEXT = 'text';
    case DATETIME = 'datetime';
    case ARRAY = 'array';
    case OBJECT = 'object';
    case BOOLEAN = 'boolean';
}