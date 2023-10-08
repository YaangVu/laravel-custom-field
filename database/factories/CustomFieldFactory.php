<?php

namespace database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Yaangvu\LaravelCustomField\Enums\CustomFieldType;
use Yaangvu\LaravelCustomField\Models\CustomField;


class CustomFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        /** @var CustomFieldType $type */
        $type = $this->faker->randomElement(CustomFieldType::cases());

        return [
            'type'        => $type->value,
            'model_type'  => 'App\Models\User',
            'required'    => false,
            'title'       => fake()->sentence(3),
            'description' => fake()->sentence(30),
            'options'     => fake()->words(),
        ];
    }
}
