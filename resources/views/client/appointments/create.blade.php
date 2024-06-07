@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Schedule New Appointment</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('client.appointments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="vehicle_id">Vehicle</label>
                    <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->registration }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>
                </div>
                <div class="form-group">
                    <label for="car_type">Car Type</label>
                    <input type="text" id="car_type" name="car_type" class="form-control" value="{{ old('car_type') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Schedule Appointment</button>
                <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
