@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Vehicle</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('client.vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" id="make" name="make" class="form-control" value="{{ old('make', $vehicle->make) }}" required>
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
                </div>
                <div class="form-group">
                    <label for="fuel_type">Fuel Type</label>
                    <select id="fuel_type" name="fuel_type" class="form-control" required>
                        <option value="gasoline" {{ $vehicle->fuel_type == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                        <option value="diesel" {{ $vehicle->fuel_type == 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="hybrid" {{ $vehicle->fuel_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="registration">Registration</label>
                    <input type="text" id="registration" name="registration" class="form-control" value="{{ old('registration', $vehicle->registration) }}" required>
                </div>
                <div class="form-group">
                    <label for="photos">Photos</label>
                    <input type="text" id="photos" name="photos" class="form-control" value="{{ old('photos', $vehicle->photos) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Vehicle</button>
                <a href="{{ route('client.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
