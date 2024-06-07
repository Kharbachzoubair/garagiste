@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Appointment Details</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Date:</strong> {{ $appointment->date }}</p>
                <p><strong>Time:</strong> {{ $appointment->time }}</p>
                <p><strong>Client Name:</strong> {{ $appointment->client->full_name }}</p>
                <p><strong>Vehicle:</strong> {{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }}</p>
                <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                @if ($appointment->status == 'completed')
                    <p><strong>Completion Date:</strong> {{ $appointment->completed_at }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
