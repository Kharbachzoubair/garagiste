@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Assign Mechanic to Appointment</h2>
        <form action="{{ route('admin.appointments.assign', $appointment->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mechanic_id">Select Mechanic:</label>
                <select name="mechanic_id" id="mechanic_id" class="form-control" required>
                    <option value="" selected disabled>Select Mechanic</option>
                    @foreach ($mechanics as $mechanic)
                        <option value="{{ $mechanic->id }}">{{ $mechanic->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
@endsection
