@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Vehicle</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('client.vehicles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" id="make" name="make" class="form-control" value="{{ old('make') }}" required>
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" class="form-control" value="{{ old('model') }}" required>
                </div>
                <div class="form-group">
                    <label for="fuel_type">Fuel Type</label>
                    <select id="fuel_type" name="fuel_type" class="form-control" required>
                        <option value="gasoline">Gasoline</option>
                        <option value="diesel">Diesel</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="registration">Registration</label>
                    <input type="text" id="registration" name="registration" class="form-control" value="{{ old('registration') }}" required>
                </div>
                <div class="form-group">
                    <label for="photos">Photos</label>
                    <input type="text" id="photos" name="photos" class="form-control" value="{{ old('photos') }}">
                </div>
                <button type="submit" class="btn btn-primary">Save Vehicle</button>
                <a href="{{ route('client.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
