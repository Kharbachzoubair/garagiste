<?php
// app/Policies/VehiclePolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Vehicle $vehicle)
    {
        return $user->client->id === $vehicle->client_id;
    }

    public function delete(User $user, Vehicle $vehicle)
    {
        return $user->client->id === $vehicle->client_id;
    }
}
