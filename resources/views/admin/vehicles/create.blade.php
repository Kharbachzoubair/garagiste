@extends('layouts.master')

@section('content')
<div>
    <h1>Add New Vehicle</h1>
    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="client_id">Client:</label>
            <select name="client_id" class="form-control" required>
                <option value="">Choose Client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="make">Make:</label>
            <input type="text" name="make" class="form-control" required value="{{ old('make') }}">
            @error('make')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" required value="{{ old('model') }}">
            @error('model')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
       
        
        <div class="form-group">
            <label for="registration">Registration:</label>
            <input type="text" name="registration" class="form-control" value="{{ old('registration') }}">
            @error('registration')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="fuel_type">Fuel Type:</label>
            <select name="fuel_type" class="form-control" required>
                <option value="">Choose Fuel Type</option>
                <option value="gasoline" {{ old('fuel_type') == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
            @error('fuel_type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="photo">Photo (Optional):</label>
            <input type="file" name="photo" class="form-control">
            @error('photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
