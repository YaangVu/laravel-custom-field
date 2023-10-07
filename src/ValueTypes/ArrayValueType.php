<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class ArrayValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::JSON;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): mixed
    {
        return json_decode($value, true);
    }
}