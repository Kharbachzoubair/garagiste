@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Repairs for {{ $vehicle->make }} {{ $vehicle->model }}</h2>
            <a href="{{ route('admin.repairs.create') }}" class="btn btn-primary">Add New Repair</a>
        </div>
    </div>

    <div class="row">
        @if($vehicle->repairs->isEmpty())
            <div class="col-md-12">
                <div class="alert alert-info">No repairs found for this vehicle.</div>
            </div>
        @else
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
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
                        @foreach ($vehicle->repairs as $rep)
                            <tr>
                                <td>{{ $rep->id }}</td>
                                <td>{{ $rep->client ? $rep->client->name : 'N/A' }}</td>
                                <td>{{ $rep->mechanic ? $rep->mechanic->name : 'N/A' }}</td>
                                <td>{{ $rep->start_date }}</td>
                                <td>{{ $rep->end_date }}</td>
                                <td>{{ $rep->description }}</td>
                                <td>{{ $rep->cost }}</td>
                                <td>{{ $rep->status }}</td>
                                <td>
                                    <a href="{{ route('admin.repairs.edit', $rep->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.repairs.destroy', $rep->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this repair?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Spare Parts for Repair #{{ $rep->id }}</h5>
                                            <a href="{{ route('admin.spare_parts.create', ['repair_id' => $rep->id]) }}" class="btn btn-primary float-right">Add New Spare Part</a>
                                        </div>
                                        <div class="card-body">
                                            @if($rep->spareParts->isEmpty())
                                                <div class="alert alert-info">No spare parts found for this repair.</div>
                                            @else
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Reference</th>
                                                            <th>Supplier</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rep->spareParts as $sparePart)
                                                            <tr>
                                                                <td>{{ $sparePart->part_name }}</td>
                                                                <td>{{ $sparePart->part_reference }}</td>
                                                                <td>{{ $sparePart->supplier }}</td>
                                                                <td>{{ $sparePart->price }}</td>
                                                                <td>{{ $sparePart->stock }}</td>
                                                                <td>
                                                                    <a href="{{ route('admin.spare_parts.edit', $sparePart->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                                    <form action="{{ route('admin.spare_parts.destroy', $sparePart->id) }}" method="POST" style="display: inline-block;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this spare part?')">Delete</button>
                                                                    </form>
                                                                    
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
