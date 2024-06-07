<?php
// database/seeders/ClientSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Appointment;

class ClientSeeder extends Seeder
{
    public function run()
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'Sample User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create a client linked to the user
        $client = Client::factory()->create([
            'user_id' => $user->id,
            'name' => 'Sample Client',
            'address' => '123 Main St',
            'phone_number' => '555-555-5555',
        ]);

        // Create a vehicle linked to the client
        $vehicle = Vehicle::factory()->create([
            'client_id' => $client->id,
            'make' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2020,
        ]);

        // Create an appointment linked to the client and vehicle
        Appointment::factory()->create([
            'client_id' => $client->id,
            'vehicle_id' => $vehicle->id,
            'date' => now()->addDays(1),
            'time' => '10:00',
            'status' => 'pending',
        ]);
    }
}
