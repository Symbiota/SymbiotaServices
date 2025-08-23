<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Contact;

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
        Contact::factory(15)->create();
        Customer::factory(10)->create();
        $contracts = Contract::factory(20)->create();

        /*
        $contracts->each(function ($contract) use ($services) {
            $contract->services()->attach(
                $services->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
        */
    }
}
