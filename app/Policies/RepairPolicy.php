<?php

namespace App\Policies;

use App\Models\Repair;
use App\Models\User;

class RepairPolicy
{
    public function update(User $user, Repair $repair): bool
    {
        // Only allow updating status for mechanics
        return $user->role === 'mechanic' && $repair->mechanic_id === $user->id;
    }

    public function delete(User $user, Repair $repair): bool
    {
        // Allow mechanics to delete their own repairs
        return $user->role === 'mechanic' && $repair->mechanic_id === $user->id;
    }
}
