@extends('layouts.master')

@section('content')
<div>
    <h1>Edit Vehicle</h1>
    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="client_id">Client:</label>
            <select name="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $vehicle->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="make">Make:</label>
            <input type="text" name="make" class="form-control" value="{{ $vehicle->make }}" required>
        </div>

        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}" required>
        </div>

        <div class="form-group">
            <label for="registration">Registration:</label>
            <input type="text" name="registration" class="form-control" value="{{ $vehicle->registration }}">
        </div>

        <div class="form-group">
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" name="fuel_type" class="form-control" value="{{ $vehicle->fuel_type }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
</div>
@endsection
