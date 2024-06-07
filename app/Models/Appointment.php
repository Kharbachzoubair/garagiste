<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AcceptedAppointment; // Add this line
use App\Models\RefusedAppointment;  // Add this line

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vehicle_id',
        'mechanic_id',
        'date',
        'car_type',
        'description',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function accepted()
    {
        return $this->hasOne(AcceptedAppointment::class);
    }

    public function refused()
    {
        return $this->hasOne(RefusedAppointment::class);
    }
}
