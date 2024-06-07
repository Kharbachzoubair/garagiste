<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Notifications\AppointmentStatusNotification;
use App\Notifications\AppointmentDeletedNotification;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('client', 'vehicle', 'mechanic')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('admin.appointments.create', compact('clients', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:users,id',
            'date' => 'required|date',
            'car_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment added successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('admin.appointments.edit', compact('appointment', 'clients', 'vehicles'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:users,id',
            'date' => 'required|date',
            'car_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function accept(Appointment $appointment)
    {
        $appointment->update(['status' => 'accepted']);
        $appointment->accepted()->create();

        $appointment->client->user->notify(new AppointmentStatusNotification('accepted'));

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment accepted successfully.');
    }

    public function refuse(Appointment $appointment)
    {
        $appointment->update(['status' => 'refused']);
        $appointment->refused()->create();

        $appointment->client->user->notify(new AppointmentStatusNotification('refused'));
        $appointment->client->user->notify(new AppointmentDeletedNotification());

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment refused and deleted successfully.');
    }
}
