<?php

namespace Yaangvu\LaravelCustomField\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\App;
use Yaangvu\LaravelCustomField\ValueTypes\ValueType;

class CustomFieldValue extends Model
{
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function customField(): BelongsTo
    {
        return $this->belongsTo(config('custom-fields.models.custom-field', 'field_id'));
    }

    public function value()
    {
        return Attribute::make(
            get: fn(string $value, array $attributes) => App::makeWith(ValueType::class, [
                'type'  => $attributes['type'],
                'field' => $this,
            ])->getValue(),
        );
    }
}