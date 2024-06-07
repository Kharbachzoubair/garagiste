<?php
namespace App\Providers;

use App\Models\Vehicle;
use App\Policies\VehiclePolicy;
use App\Models\Repair;
use App\Models\Appointment;
use App\Policies\RepairPolicy;
use App\Policies\AppointmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vehicle::class => VehiclePolicy::class,
        Repair::class => RepairPolicy::class,
        Appointment::class => AppointmentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
