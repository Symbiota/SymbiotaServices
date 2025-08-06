<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'darbi_customer_account_number' => $this->faker->numberBetween(1000, 9999),
            'darbi_site' => $this->faker->word(),
            'correspondence' => $this->faker->email(),
            'notes' => $this->faker->text(),
        ];
    } // to use: php artisan tinker, App\Models\Customer::factory(number)->create()
}
