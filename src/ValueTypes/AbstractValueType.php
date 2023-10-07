<?php

namespace Yaangvu\LaravelCustomField\ValueTypes;

use Yaangvu\LaravelCustomField\Models\CustomFieldValue;

abstract class AbstractValueType implements ValueType
{
    /**
     * @inheritDoc
     */
    public function __construct(protected readonly CustomFieldValue $fieldValue) { }

    /**
     * @inheritDoc
     */
    public function getValue(): mixed
    {
        return $this->castValue($this->fieldValue->getAttribute($this->getField()->value));
    }

    /**
     * @inheritDoc
     */
    public function setValue(mixed $value): void
    {
        $this->fieldValue->setAttribute($this->getField()->value, $this->castValue($value));
    }
}