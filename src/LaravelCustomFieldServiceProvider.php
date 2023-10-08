<?php

namespace Yaangvu\LaravelCustomField;

use Illuminate\Support\ServiceProvider;
use Yaangvu\LaravelCustomField\ValueTypes\ValueType;

class LaravelCustomFieldServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/custom-fields.php', 'custom-fields');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../config/custom-fields.php' => config_path('custom-fields.php')],
                         'custom-fields-config');

        if (!class_exists('CreateCustomFieldsTables')) {
            $this->publishes(
                [__DIR__ . '/../database/migrations/create_custom_fields_tables.php' =>
                     database_path('migrations/' . date('Y_m_d_His', time()) . '_create_custom_fields_tables.php')],
                'migrations');
        }

        $this->app->bind(ValueType::class, function ($app, $params) {
            $valueTypeClass = config('custom-fields.values.' . $params['type']);

            return new $valueTypeClass($params['value']);
        });
    }
}