<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Enums\CustomFieldValueType;

class CheckBoxValueType extends AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function getField(): CustomFieldValueType
    {
        return CustomFieldValueType::BOOLEAN;
    }

    /**
     * @inheritDoc
     */
    public function castValue(mixed $value): bool
    {
        return $value ? 'Checked' : 'UnChecked';
    }
}