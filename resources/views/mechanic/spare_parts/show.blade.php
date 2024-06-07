@extends('layouts.master')

@section('content')
<div class="container">
    <h2>{{ $sparePart->name }}</h2>
    <p>Stock: {{ $sparePart->stock }}</p>
    <!-- Display more details as needed -->
</div>
@endsection
