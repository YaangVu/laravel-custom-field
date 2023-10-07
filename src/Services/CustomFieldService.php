<?php

namespace Yaangvu\LaravelCustomField\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class CustomFieldService
{
    /**
     * @param Model|Builder $field
     * @param string        $modelType
     */
    public function __construct(private readonly Model|Builder $field, private readonly string $modelType) { }

    public function get(): Collection|array
    {
        return $this->field->where('model_type', '=', $this->modelType)
                           ->orderBy('order')
                           ->get();
    }

    public function add(string  $type, string $title, ?bool $required = null, ?string $description = null,
                        ?string $default_value = null, ?array $options = null, ?int $order = null): Model
    {
        /**
         * @var Model $model
         */
        $model = clone $this->field;
        $model->setAttribute('model_type', $this->modelType);
        $model->setAttribute('type', $type);
        $model->setAttribute('title', $title);
        $model->setAttribute('required', $required);
        $model->setAttribute('description', $description);
        $model->setAttribute('default_value', $default_value);
        $model->setAttribute('options', $options);
        $model->setAttribute('order', $order);
        $model->save();

        return $model;
    }
}