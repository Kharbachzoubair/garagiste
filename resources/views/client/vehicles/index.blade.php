@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Your Vehicles</h5>
        </div>
        <div class="card-body">
            @if ($vehicles->isEmpty())
                <p>You have no vehicles registered.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Registration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->registration }}</td>
                                    <td>
                                        <a href="{{ route('client.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('client.vehicles.confirm-delete', $vehicle->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <a href="{{ route('client.vehicles.create') }}" class="btn btn-success">Add New Vehicle</a>
        </div>
    </div>
@endsection
