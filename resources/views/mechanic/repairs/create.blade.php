@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Repair</h1>
    <form action="{{ route('mechanic.repairs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>
        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->make }} {{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="client_id">Client</label>
            <input type="text" class="form-control" id="client_id" name="client_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
