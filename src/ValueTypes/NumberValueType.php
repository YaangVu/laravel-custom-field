<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class NumberValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::NUMBER;
    }


    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): float
    {
        return (float)$value;
    }
}