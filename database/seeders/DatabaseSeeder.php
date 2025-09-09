<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Contact;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        $services = Service::factory(6)->create();
        Contact::factory(10)->create();
        Customer::factory(6)->create();
        Contract::factory(15)->create();
        $invoices = Invoice::factory(20)->create();

        $invoices->each(function ($invoice) use ($services) {
            $invoice->services()->attach(
                $services->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
