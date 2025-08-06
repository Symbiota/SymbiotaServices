<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Contact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->randomElement(Customer::pluck('id')), 
            'darbi_header_ref_1' => $this->faker->word(),
            'darbi_header_ref_2' => $this->faker->word(),
            'original_contact_id' => Contact::factory(),
            'darbi_special_instructions' => $this->faker->text(),
            'notes' => $this->faker->text(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date()
        ];
    } // to use: php artisan tinker, generate customers first, then App\Models\Contract::factory(number)->create() - also generates contacts
}