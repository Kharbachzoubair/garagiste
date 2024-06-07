@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Confirm Appointment Cancellation
        </div>
        <div class="card-body">
            <p>Are you sure you want to cancel the appointment for {{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }} on {{ $appointment->date }}?</p>
            <form action="{{ route('client.appointments.destroy', $appointment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancel Appointment</button>
                <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
