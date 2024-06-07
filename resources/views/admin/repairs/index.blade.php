@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Repairs</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Vehicle</th>
                                    <th>Mechanic</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($repairs as $repair)
                                    <tr>
                                        <td>{{ $repair->id }}</td>
                                        <td>{{ $repair->client ? $repair->client->name : 'N/A' }}</td>
                                        <td>{{ $repair->vehicle ? $repair->vehicle->make . ' ' . $repair->vehicle->model : 'N/A' }}</td>
                                        <td>{{ $repair->mechanic ? $repair->mechanic->name : 'N/A' }}</td>
                                        <td>{{ $repair->start_date }}</td>
                                        <td>{{ $repair->end_date }}</td>
                                        <td>{{ $repair->description }}</td>
                                        <td>{{ $repair->cost }}</td>
                                        <td>{{ $repair->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.repairs.edit', $repair->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.repairs.destroy', $repair->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this repair?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.repairs.create') }}" class="btn btn-success">Add Repair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
