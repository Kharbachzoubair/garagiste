@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            Mechanic assigned to the appointment successfully.
        </div>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-primary">Back to Appointments</a>
    </div>
@endsection
