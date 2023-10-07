<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldType;
use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;
use Yaangvu\LaravelCustomField\Models\CustomFieldValue;

interface ValueType
{
    /**
     * @param CustomFieldValue $fieldValue
     */
    public function __construct(CustomFieldValue $fieldValue);

    /**
     * Get field has contained value
     * @return CustomFieldType
     */
    public function getField(): CustomFieldValueType;

    /**
     * Set value
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue(mixed $value): void;

    /**
     * Get value
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * Cast value base on ValueType
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function castValue(mixed $value): mixed;
}