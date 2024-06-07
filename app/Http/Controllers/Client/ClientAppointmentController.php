<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentStatusNotification;
use App\Notifications\AppointmentDeletedNotification;

class ClientAppointmentController extends Controller
{
    public function create()
    {
        $vehicles = Auth::user()->client->vehicles;
        return view('client.appointments.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date' => 'required|date',
            'car_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $client = Auth::user()->client;
        $client->appointments()->create($request->all());

        return redirect()->route('client.appointments.index')->with('success', 'Appointment requested successfully.');
    }

 // ClientAppointmentController.php

public function index()
{
    $client = Auth::user()->client;
    $appointments = $client->appointments()->whereNotIn('id', function ($query) {
        $query->select('appointment_id')->from('refused_appointments');
    })->with('vehicle')->get();

    return view('client.appointments.index', compact('appointments'));
}

}
