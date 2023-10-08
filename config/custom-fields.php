<?php

return [
    'form-name' => env('CUSTOM_FIELDS_FORM_NAME', 'custom_fields'),

    'tables' => [
        'custom-fields'       => env('CUSTOM_FIELDS_TABLE', 'custom_fields'),
        'custom-field-values' => env('CUSTOM_FIELD_VALUES_TABLE', 'custom_field_values'),
    ],

    'models' => [
        'custom-field'       => \Yaangvu\LaravelCustomField\Models\CustomField::class,
        'custom-field-value' => \Yaangvu\LaravelCustomField\Models\CustomFieldValue::class,
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
    'values' => [
        'array'    => \Yaangvu\LaravelCustomField\ValueTypes\ArrayValueType::class,
        'boolean'  => \Yaangvu\LaravelCustomField\ValueTypes\BooleanValueType::class,
        'checkbox' => \Yaangvu\LaravelCustomField\ValueTypes\CheckboxValueType::class,
        'datetime' => \Yaangvu\LaravelCustomField\ValueTypes\DatetimeValueType::class,
        'int'      => \Yaangvu\LaravelCustomField\ValueTypes\IntValueType::class,
        'number'   => \Yaangvu\LaravelCustomField\ValueTypes\NumberValueType::class,
        'object'   => \Yaangvu\LaravelCustomField\ValueTypes\ObjectValueType::class,
        'radio'    => \Yaangvu\LaravelCustomField\ValueTypes\RadioValueType::class,
        'select'   => \Yaangvu\LaravelCustomField\ValueTypes\SelectValueType::class,
        'string'   => \Yaangvu\LaravelCustomField\ValueTypes\StringValueType::class,
        'text'     => \Yaangvu\LaravelCustomField\ValueTypes\TextValueType::class,
    ],
];
