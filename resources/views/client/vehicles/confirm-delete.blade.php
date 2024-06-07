@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Confirm Delete</h5>
        </div>
        <div class="card-body">
            <p>Are you sure you want to delete this vehicle?</p>
            <form action="{{ route('client.vehicles.destroy', $vehicle->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="{{ route('client.vehicles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
