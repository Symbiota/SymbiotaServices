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
            'original_contact_id' => $this->faker->randomElement(Contact::pluck('id')),
            'current_financial_contact_id' => $this->faker->randomElement(Contact::pluck('id')),
            'pi_contact_id' => $this->faker->optional()->randomElement(Contact::pluck('id')),
            'technical_contact_id' => $this->faker->optional()->randomElement(Contact::pluck('id')),
            'darbi_header_ref_1' => $this->faker->word(),
            'darbi_header_ref_2' => $this->faker->word(),
            'darbi_special_instructions' => $this->faker->text(),
            'notes' => $this->faker->text(),
        ];
    }
}
