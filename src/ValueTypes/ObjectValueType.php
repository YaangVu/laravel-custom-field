<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class ObjectValueType extends AbstractValueType implements ValueType
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
        return json_decode($value, false);
    }
}