<?php

namespace Yaangvu\LaravelCustomField\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CustomFieldValue extends Model
{
    protected $fillable
        = [
            'field_id',
            'model_id',
            'model_type',
            'value_boolean',
            'value_string',
            'value_text',
            'value_int',
            'value_number',
            'value_json',
            'value_datetime'
        ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(config('custom-fields.models.custom-field', 'field_id'));
    }
}