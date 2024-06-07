@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Appointments</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Vehicle</th>
                                    <th>Date</th>
                                    <th>Car Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->client->name }}</td>
                                        <td>{{ $appointment->vehicle->make }} {{ $appointment->vehicle->model }}</td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>{{ $appointment->car_type }}</td>
                                        <td>{{ $appointment->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.appointments.create') }}" class="btn btn-success">Add Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
