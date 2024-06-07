@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Repairs</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('mechanic.repairs.create') }}" class="btn btn-success mb-3">Create Repair</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Vehicle</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repairs as $repair)
                <tr>
                    <td>{{ $repair->id }}</td>
                    <td>{{ $repair->description }}</td>
                    <td>{{ $repair->status }}</td>
                    <td>{{ $repair->start_date }}</td>
                    <td>{{ $repair->end_date }}</td>
                    <td>{{ $repair->vehicle->make }} {{ $repair->vehicle->model }}</td>
                    <td>{{ $repair->client->name }}</td>
                    <td>
                        <a href="{{ route('mechanic.repairs.edit', $repair->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('mechanic.repairs.destroy', $repair->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
