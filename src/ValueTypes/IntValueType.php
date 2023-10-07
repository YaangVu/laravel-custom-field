<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class IntValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::INT;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): float
    {
        return (int)$value;
    }
}