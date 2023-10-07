<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class TextValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::TEXT;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): mixed
    {
        return $value;
    }
}