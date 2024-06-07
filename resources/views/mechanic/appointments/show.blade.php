@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Appointment Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>Client Name</th>
            <td>{{ $appointment->client->name }}</td>
        </tr>
        <tr>
            <th>Vehicle</th>
            <td>{{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $appointment->date }}</td>
        </tr>
        <tr>
            <th>Time</th>
            <td>{{ $appointment->time }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $appointment->status }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $appointment->description }}</td>
        </tr>
    </table>
    <a href="{{ route('mechanic.appointments.index') }}" class="btn btn-primary">Back to Appointments</a>
</div>
@endsection
