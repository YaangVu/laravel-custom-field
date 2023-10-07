<?php

use Yaangvu\LaravelCustomFields\FieldTypes\CheckboxFieldType;
use Yaangvu\LaravelCustomFields\FieldTypes\NumberFieldType;
use Yaangvu\LaravelCustomFields\FieldTypes\RadioFieldType;
use Yaangvu\LaravelCustomFields\FieldTypes\SelectFieldType;
use Yaangvu\LaravelCustomFields\FieldTypes\TextareaFieldType;
use Yaangvu\LaravelCustomFields\FieldTypes\TextFieldType;
use Yaangvu\LaravelCustomFields\Models\CustomField;
use Yaangvu\LaravelCustomFields\Models\CustomFieldValue;
use Yaangvu\LaravelCustomFields\Types\ArrayValueType;
use Yaangvu\LaravelCustomFields\Types\BooleanValueType;
use Yaangvu\LaravelCustomFields\Types\CheckboxValueType;
use Yaangvu\LaravelCustomFields\Types\DatetimeValueType;
use Yaangvu\LaravelCustomFields\Types\IntValueType;
use Yaangvu\LaravelCustomFields\Types\NumberValueType;
use Yaangvu\LaravelCustomFields\Types\ObjectValueType;
use Yaangvu\LaravelCustomFields\Types\RadioValueType;
use Yaangvu\LaravelCustomFields\Types\SelectValueType;
use Yaangvu\LaravelCustomFields\Types\StringValueType;
use Yaangvu\LaravelCustomFields\Types\TextValueType;

return [
    'form-name' => env('CUSTOM_FIELDS_FORM_NAME', 'custom_fields'),

    'tables' => [
        'fields'       => env('CUSTOM_FIELDS_TABLE', 'custom_fields'),
        'field-values' => env('CUSTOM_FIELD_VALUES_TABLE', 'custom_field_values'),
    ],

    'models'       => [
        'custom-field'       => CustomField::class,
        'custom-field-value' => CustomFieldValue::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Field Types
    | -------------------------------------------------------------------
    |
    | The list of all custom field types. You can register
    | your own custom field types here. Make sure to also
    | register the corresponding value type below.
    */
    'fields'       => [
        'checkbox' => CheckboxFieldType::class,
        'number'   => NumberFieldType::class,
        'radio'    => RadioFieldType::class,
        'select'   => SelectFieldType::class,
        'textarea' => TextareaFieldType::class,
        'text'     => TextFieldType::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Value Types
    | -------------------------------------------------------------------
    |
    | The list of all custom field value types. You can register
    | your own custom field values here. Make sure to also
    | register the corresponding field type above.
    */
    'values'       => [
        'array'    => ArrayValueType::class,
        'boolean'  => BooleanValueType::class,
        'checkbox' => CheckboxValueType::class,
        'datetime' => DatetimeValueType::class,
        'int'      => IntValueType::class,
        'number'   => NumberValueType::class,
        'object'   => ObjectValueType::class,
        'radio'    => RadioValueType::class,
        'select'   => SelectValueType::class,
        'string'   => StringValueType::class,
        'text'     => TextValueType::class,
    ],

    /*
    | -------------------------------------------------------------------
    | Value Fields
    | -------------------------------------------------------------------
    |
    | The list of all value columns that can hold a value on the
    | custom_field_values table.
    */
    'value-fields' => [
        'value_int',
        'value_str',
        'value_text',
        'value_json',
    ],

];
