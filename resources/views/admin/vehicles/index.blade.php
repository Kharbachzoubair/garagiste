@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">Add New Vehicle</a>
        </div>
    </div>
    <div class="row">
        @foreach ($vehicles as $vehicle)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($vehicle->photo)
                        <a href="{{ route('admin.vehicles.repairs', $vehicle->id) }}">
                            <img src="{{ asset('storage/' . $vehicle->photo) }}" class="card-img-top" alt="Vehicle Photo">
                        </a>
                    @else
                        <a href="{{ route('admin.vehicles.repairs', $vehicle->id) }}">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image Available">
                        </a>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->make }} {{ $vehicle->model }}</h5>
                        <p class="card-text"><strong>Client:</strong> {{ $vehicle->client->name }}</p>
                        
                        <p class="card-text"><strong>Registration:</strong> {{ $vehicle->registration }}</p>
                        <p class="card-text"><strong>Fuel Type:</strong> {{ ucfirst($vehicle->fuel_type) }}</p>
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
