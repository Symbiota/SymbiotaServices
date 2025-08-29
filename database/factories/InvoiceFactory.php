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
        return [
            'contract_id' => $this->faker->randomElement(Contract::pluck('id')),
            'financial_contact_id' => $this->faker->randomElement(Contact::pluck('id')),
            'billing_start' => $this->faker->dateTime(),
            'billing_end' => $this->faker->dateTime(),
            'amount_billed' => 0,
            'date_invoiced' => $this->faker->dateTime(),
            'date_paid' => $this->faker->dateTime(),
            'notes' => $this->faker->text(),
        ];
    }
}
