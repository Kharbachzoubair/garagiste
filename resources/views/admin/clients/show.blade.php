<!-- clients/show.blade.php -->
@extends('layouts.master')

@section('content')
    <h1>{{ $client->first_name }} {{ $client->last_name }}</h1>
    <p>Address: {{ $client->address }}</p>
    <p>Phone Number: {{ $client->phone_number }}</p>
    <!-- Other details to display if needed -->
    <a href="{{ route('admin.clients.edit', $client->id) }}">Edit</a>
@endsection
