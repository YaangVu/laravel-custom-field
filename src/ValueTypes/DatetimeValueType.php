<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class DatetimeValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::DATETIME;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): mixed
    {
        return $value;
    }
}