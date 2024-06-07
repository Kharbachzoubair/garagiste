@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Edit Appointment
        </div>
        <div class="card-body">
            <form action="{{ route('client.appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="vehicle">Vehicle</label>
                    <input type="text" class="form-control" id="vehicle" name="vehicle" value="{{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }}" disabled>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $appointment->date }}">
                </div>

                <div class="form-group">
                    <label for="car_type">Car Type</label>
                    <input type="text" class="form-control" id="car_type" name="car_type" value="{{ $appointment->car_type }}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $appointment->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Appointment</button>
                <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
