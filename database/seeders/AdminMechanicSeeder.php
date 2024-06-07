<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMechanicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
public function run()
{
    // Create default admin
    User::create([
        'name' => 'Admin Name',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456789'),
        'role' => 'admin',
    ]);

    // Create default mechanics
    $mechanics = [
        ['name' => 'Mechanic 1 Name', 'email' => 'mechanic1@example.com', 'password' => bcrypt('password'), 'role' => 'mechanic'],
        ['name' => 'Mechanic 2 Name', 'email' => 'mechanic2@example.com', 'password' => bcrypt('password'), 'role' => 'mechanic'],
        // Add more mechanics as needed
    ];

    foreach ($mechanics as $mechanic) {
        User::create($mechanic);
    }
}

}
