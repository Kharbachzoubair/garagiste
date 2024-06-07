<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentStatusNotification;
use App\Notifications\AppointmentDeletedNotification;

class MechanicAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', 'pending')->with('client', 'vehicle')->get();
        return view('mechanic.appointments.index', compact('appointments'));
    }

    public function accept(Appointment $appointment)
    {
        $appointment->update(['status' => 'accepted']);
        $appointment->client->user->notify(new AppointmentStatusNotification('accepted'));

        return redirect()->route('mechanic.appointments.index')->with('success', 'Appointment accepted successfully.');
    }

    public function refuse(Appointment $appointment)
    {
        $client = $appointment->client;
        
        // Notify client about the refusal
        $client->user->notify(new AppointmentStatusNotification('refused'));

        // Delete the appointment
        $appointment->delete();

        // Notify client about the deletion
        $client->user->notify(new AppointmentDeletedNotification());

        return redirect()->route('mechanic.appointments.index')->with('success', 'Appointment refused and deleted successfully.');
    }
}
