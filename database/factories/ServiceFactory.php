<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

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
            'darbi_item_number' => $this->faker->numerify('SYMBI#####'),
            'price_per_unit' => $this->faker->numberBetween(1, 9999),
            'description' => $this->faker->word(),
        ];
    } // to use: php artisan tinker, App\Models\Service::factory(number)->create()

    public function configure(): static
    {
        return $this->afterCreating(function (Service $service) {
            $history = $service->getAttributes();
            unset($history['id']);
            $history += ['service_id' => $service->id];
            DB::table('services_history')->insert($history);
        });
    }
}
