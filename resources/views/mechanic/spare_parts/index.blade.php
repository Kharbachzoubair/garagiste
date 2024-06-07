@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Spare Parts</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Reference</th>
                <th>Supplier</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spareParts as $sparePart)
                <tr>
                    <td>{{ $sparePart->id }}</td>
                    <td>{{ $sparePart->part_name }}</td>
                    <td>{{ $sparePart->part_reference }}</td>
                    <td>{{ $sparePart->supplier }}</td>
                    <td>{{ $sparePart->price }}</td>
                    <td>{{ $sparePart->stock }}</td>
                    <td>
                        <a href="{{ route('mechanic.spare_parts.edit', $sparePart->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('mechanic.spare_parts.destroy', $sparePart->id) }}" method="POST" style="display:inline-block;">
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
