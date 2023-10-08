<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Yaangvu\LaravelCustomField\Enums\CustomFieldType;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('custom-fields.tables.custom-fields', 'custom_fields'), function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->string('type')->default(CustomFieldType::STRING->value)
                  ->comment('Type of custom field value');
            $table->string('title')->comment('Title of custom field');
            $table->boolean('required')->nullable()->comment('Require rule when submit value');
            $table->string('description')->nullable()->comment('Description of custom field');
            $table->string('default_value')->nullable()->comment('Default value when submit');
            $table->json('options')->nullable()->comment('Options for Select or Radio custom field type');
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->timestamp('archived_at')->nullable();
            $table->softDeletes();
        });

        Schema::create(config('custom-fields.tables.custom-field-values', 'custom_field_values'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('field_id');
            $table->foreign('field_id')->references('id')
                  ->on(config('custom-fields.tables.fields', 'custom_fields'))
                  ->cascadeOnDelete();
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->unique(['field_id',
                            'model_id',
                            'model_type']); // set unique for combine 3 columns: field_id, model_id, model_type
            $table->boolean('value_boolean')->nullable();
            $table->string('value_string')->nullable();
            $table->text('value_text')->nullable();
            $table->integer('value_int')->nullable();
            $table->float('value_number')->nullable();
            $table->json('value_json')->nullable();
            $table->timestamp('value_datetime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('custom-fields.tables.custom-fields', 'custom_fields'));
        Schema::dropIfExists(config('custom-fields.tables.custom-field-values', 'custom_field_values'));
    }
};
