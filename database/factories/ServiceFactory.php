<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->word(),
            'price_per_unit' => $this->faker->numberBetween(1, 10),
            'darbi_item_number' => $this->faker->numberBetween(1, 10)
        ];
    } // to use: php artisan tinker, App\Models\Service::factory(number)->create()
}