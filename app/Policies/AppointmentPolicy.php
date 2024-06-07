<?php 
// app/Policies/AppointmentPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Appointment $appointment)
    {
        return $user->id === $appointment->mechanic_id;
    }
}
