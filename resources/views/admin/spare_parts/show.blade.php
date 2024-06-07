@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $sparePart->part_name }}</h5>
            </div>
            <div class="card-body">
                <p>Repair ID: <a href="{{ route('repairs.show', $sparePart->repair_id) }}">{{ $sparePart->repair_id }}</a></p>
                <p>Reference: {{ $sparePart->part_reference }}</p>
                <p>Supplier: {{ $sparePart->supplier }}</p>
                <p>Price: {{ $sparePart->price }}</p>
                <p>Stock: {{ $sparePart->stock }}</p>
            </div>
        </div>
    </div>
@endsection
