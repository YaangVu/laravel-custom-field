<?php

namespace Yaangvu\LaravelCustomField\Traits;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Yaangvu\LaravelCustomField\Models\CustomField;
use Yaangvu\LaravelCustomField\Models\CustomFieldValue;
use Yaangvu\LaravelCustomField\Relations\HasCustomField;
use Yaangvu\LaravelCustomField\ValueTypes\ValueType;

trait HasCustomFields
{
    /**
     * Set relationship to HasCustomField Model
     *
     * @param string $related
     *
     * @return HasCustomField
     */
    public function hasCustomFields(string $related): HasCustomField
    {
        /**
         * @var Model $this
         */
        $instance = $this->newRelatedInstance($related);

        return new HasCustomField($instance->newQuery(), $this);
    }

    /**
     * Set relationship to CustomFieldValue Model
     * @return MorphMany
     */
    public function hasCustomFieldValues(): MorphMany
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
     * Get all custom fields with their values.
     * Don't recommend using this function
     *
     * @return Collection
     */
    public function getCustomFieldsWithValues(): Collection
    {
        /**
         * @var Model $this
         */
        $cfs   = $this->initCustomFieldModel()->newQuery()->where('model_type', '=', get_class($this))->get();
        $cfIds = $cfs->pluck('id');
        $cfvs  = $this->initCustomFieldValueModel()->newQuery()->where('model_type', '=', get_class($this))
                      ->where('model_id', '=', $this->getAttribute($this->getKeyName()))->whereIn('field_id', $cfIds)
                      ->get();

        $cfs->map(function (Model $cf) use ($cfvs) {
            $cfv = $cfvs->where('field_id', '=', $cf->getAttribute($cf->getKeyName()))->first();
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

    /**
     * @param array{field_id: int, model_type: string, value: mixed} $value
     *
     * @return bool
     * @throws BindingResolutionException
     */
    public function syncCustomFieldValue(array $value): bool
    {
        Validator::make($value, [
            'field_id' => 'required',
            'value'    => 'required',
        ])->validate();

        $cf = $this->initCustomFieldModel()->newQuery()->findOrFail($value['field_id']);

        /**
         * @var Model     $this
         * @var ValueType $valueType
         */
        $valueType = app()->makeWith(ValueType::class,
                                     ['type'  => $cf->getAttribute('type'),
                                      'value' => $this->initCustomFieldValueModel()]);

        $value[$valueType->getField()->value] = $valueType->castValue($value['value']);
        $value['model_type']                  = get_class($this);
        $value['model_id']                    = $this->getAttribute($this->getKeyName());
        unset($value['value']);
        $this->initCustomFieldValueModel()->newQuery()->updateOrCreate(
            [
                'model_type' => $value['model_type'],
                'field_id'   => $value['field_id'],
                'model_id'   => $value['model_id'],
            ],
            $value);

        return true;
    }

}
