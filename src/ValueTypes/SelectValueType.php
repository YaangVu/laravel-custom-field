<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class SelectValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::STRING;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): mixed
    {
        return $value;
    }
}