<?php

namespace Yaangvu\LaravelCustomField\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Yaangvu\LaravelCustomField\Models\CustomFieldValue;
use Yaangvu\LaravelCustomField\Relations\CustomField;
use Yaangvu\LaravelCustomField\ValueTypes\ValueType;

trait HasCustomFields
{
    /**
     * Set relationship to CustomField Model
     *
     * @param string $related
     *
     * @return CustomField
     */
    public function customFields(string $related): CustomField
    {
        /**
         * @var Model $this
         */
        $instance = $this->newRelatedInstance($related);

        return new CustomField($instance->newQuery(), $this);
    }

    /**
     * Set relationship to CustomFieldValue Model
     * @return MorphMany
     */
    public function customFieldValues(): MorphMany
    {
        /**
         * @var Model $this
         */
        return $this->morphMany(config('custom-fields.models.custom-field-value'), 'model');
    }

    /**
     * Get all custom fields of one Model
     * @return mixed
     */
    public function getCustomFields(): mixed
    {
        $fieldClass = config('custom-fields.models.custom-field');

        return $fieldClass::newQuery()->where('model_type', '=', get_class($this))->get();
    }

    /**
     * Get all custom fields with their values
     * @return Collection
     */
    public function getCustomFieldsWithValues(): Collection
    {
        /**
         * @var Model $this
         */
        $cfs   = $this->initCustomFieldModel()
                      ->newQuery()
                      ->where('model_type', '=', get_class($this))
                      ->get();
        $cfIds = $cfs->pluck('id');
        $cfvs  = $this->initCustomFieldValueModel()
                      ->newQuery()
                      ->where('model_type', '=', get_class($this))
                      ->where('model_id', '=', $this->getAttribute($this->getKeyName()))
                      ->whereIn('field_id', $cfIds)
                      ->get();

        $cfs->map(function (Model $cf) use ($cfvs) {
            $cfv = $cfvs->where('field_id', '=', $cf->getAttribute('id'))->first();
            if (!is_null($cfv)) {
                /**
                 * @var ValueType $valueType
                 */
                $valueType = app()->makeWith(ValueType::class, ['type' => $cf->getAttribute('type'), 'value' => $cfv]);
                $cfv       = $valueType->getValue();
            }

            $cf->setAttribute('value', $cfv ?? null);

            return $cf;
        });

        return $cfs;
    }

    /**
     * @param array|Collection $values
     *
     * @return int
     */
    public function syncCustomFieldValues(array|Collection $values): int
    {
        if (is_array($values))
            $values = collect($values);

        $fieldIds = $values->pluck('field_id');
        $fields   = $this->initCustomFieldModel()->whereIn('id', $fieldIds)->get();

        $fieldValueClass = config('custom-fields.models.custom-field-value');
        /**
         * @var Model $fieldValue
         */
        $fieldValue           = new $fieldValueClass();
        $values['model_type'] = get_class($this);

        return $fieldValue->newQuery()->upsert($values, ['model_type', 'field_id', 'model_id']);
    }

    /**
     * Init Custom Field Model
     * @return CustomField
     */
    public function initCustomFieldModel(): CustomField
    {
        $class = config('custom-fields.models.custom-field');

        return new $class();
    }

    /**
     * Init Custom Field Value Model
     * @return CustomFieldValue
     */
    public function initCustomFieldValueModel(): CustomFieldValue
    {
        $class = config('custom-fields.models.custom-field-value');

        return new $class();
    }
}
