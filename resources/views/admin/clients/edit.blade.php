<!-- resources/views/admin/clients/edit.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Client</h1>
        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $client->address }}" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $client->phone_number }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Client</button>
        </form>
    </div>
@endsection
