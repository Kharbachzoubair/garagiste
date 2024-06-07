@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Repair</h1>
    <form action="{{ route('mechanic.repairs.update', $repair->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $repair->description }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" {{ $repair->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="ongoing" {{ $repair->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ $repair->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $repair->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $repair->end_date }}">
        </div>
        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $repair->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->make }} {{ $vehicle->model }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="client_id">Client</label>
            <input type="text" class="form-control" id="client_id" name="client_id" value="{{ $repair->client_id }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
