@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Spare Parts</h5>
                        
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Repair ID</th>
                                    <th>Name</th>
                                    <th>Reference</th>
                                    <th>Supplier</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spareParts as $sparePart)
                                    <tr>
                                        <td>{{ $sparePart->repair_id }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
