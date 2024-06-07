@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Your Appointments</h5>
        </div>
        <div class="card-body">
            @if ($appointments->isEmpty())
                <p>You have no appointments scheduled.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Date</th>
                                <th>Car Type</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->car_type }}</td>
                                    <td>{{ $appointment->description }}</td>
                                    <td>
                                        <a href="{{ route('client.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('client.appointments.confirm-delete', $appointment->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <a href="{{ route('client.appointments.create') }}" class="btn btn-success">Schedule New Appointment</a>
        </div>
    </div>
@endsection

