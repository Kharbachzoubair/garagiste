@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Pending Appointments</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($appointments->isEmpty())
            <div class="alert alert-info">
                <p>No pending appointments.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Car Type</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->client->name }}</td>
                                <td>{{ $appointment->vehicle->make }} - {{ $appointment->vehicle->model }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->car_type }}</td>
                                <td>{{ $appointment->description }}</td>
                                <td>
                                    <form action="{{ route('mechanic.appointments.accept', $appointment) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    <form action="{{ route('mechanic.appointments.refuse', $appointment) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">Refuse</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
