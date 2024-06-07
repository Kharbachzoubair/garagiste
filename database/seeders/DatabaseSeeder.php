<?php 
 use Illuminate\Database\Seeder;
 use App\Models\User;
 use App\Models\Client;
 use App\Models\Vehicle;
 use App\Models\Appointment;
 
 class DatabaseSeeder extends Seeder
 {
     public function run()
     {
         $user = User::factory()->create([
             'email' => 'client@example.com',
             'password' => bcrypt('password'),
         ]);
 
         $client = Client::create([
             'name' => 'Client Name',
             'address' => 'Client Address',
             'phone_number' => '123456789',
             'user_id' => $user->id,
             'email' => $user->email,
         ]);
 
         $vehicle1 = Vehicle::create([
             'make' => 'Toyota',
             'model' => 'Camry',
             'year' => '2020',
             'client_id' => $client->id,
         ]);
 
         $vehicle2 = Vehicle::create([
             'make' => 'Honda',
             'model' => 'Accord',
             'year' => '2019',
             'client_id' => $client->id,
         ]);
 
         Appointment::create([
             'client_id' => $client->id,
             'vehicle_id' => $vehicle1->id,
             'date' => '2024-06-01',
             'time' => '10:00',
             'status' => 'pending',
         ]);
 
         Appointment::create([
             'client_id' => $client->id,
             'vehicle_id' => $vehicle2->id,
             'date' => '2024-06-02',
             'time' => '11:00',
             'status' => 'pending',
         ]);
     }
 }
 