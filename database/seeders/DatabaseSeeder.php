<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Client;
use Database\Factories\ClientFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Car::factory(10)->create();
        Client::factory(10)->create();
    }
}
