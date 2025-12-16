<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contract;
use App\Models\Contact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contract = Contract::inRandomOrder()->first();

        return [
            'contract_id' => $contract->id,
            'financial_contact_id' => $this->faker->randomElement(Contact::pluck('id')),
            'billing_start' => $this->faker->dateTime(),
            'billing_end' => $this->faker->dateTime(),
            'amount_billed' => 0,
            'date_invoiced' => $this->faker->optional(0.8)->dateTime(),
            'date_paid' => $this->faker->optional(0.8)->dateTime(),
            'darbi_header_ref_1' => $this->faker->boolean(0.75) ? $contract->darbi_header_ref_1 : $this->faker->word(),
            'darbi_header_ref_2' => $this->faker->boolean(0.75) ? $contract->darbi_header_ref_2 : $this->faker->word(),
            'notes' => $this->faker->text(),
        ];
    }
}
