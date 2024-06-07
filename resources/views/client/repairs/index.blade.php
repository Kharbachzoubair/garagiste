@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Your Repairs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Mechanic</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repairs as $repair)
            <tr>
                <td>{{ $repair->vehicle->make }} {{ $repair->vehicle->model }}</td>
                <td>{{ $repair->mechanic->name }}</td>
                <td>{{ $repair->description }}</td>
                <td>{{ $repair->status }}</td>
                <td>{{ $repair->date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
