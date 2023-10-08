<?php

namespace Yaangvu\LaravelCustomField\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomField extends Model
{
    protected $fillable
        = ['model_type',
           'title',
           'required',
           'description',
           'default_value',
           'options',
           'order',
           'archived_at'];

    /**
     * Get all values that has field_id = fields.id
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(CustomFieldValue::class);
    }

    /**
     * Get the first value that has field_id = fields.id
     * @return HasOne
     */
    public function value(): HasOne
    {
        return $this->hasOne(CustomField::class);
    }

    public function options()
    {
        return Attribute::make(get: fn(mixed $value) => json_decode($value),
            set: fn(mixed $value) => json_encode($value),);
    }
}