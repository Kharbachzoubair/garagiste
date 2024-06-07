@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ $repair->description }}</h5>
            </div>
            <div class="card-body">
                <p>Vehicle: <a href="{{ route('vehicles.show', $repair->vehicle->id) }}">{{ $repair->vehicle->name }}</a></p>
                <p>Date: {{ $repair->repair_date }}</p>
                <h6>Spare Parts:</h6>
                <ul>
                    @foreach ($repair->spareParts as $sparePart)
                        <li>
                            <a href="{{ route('spare_parts.show', $sparePart->id) }}">{{ $sparePart->part_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
