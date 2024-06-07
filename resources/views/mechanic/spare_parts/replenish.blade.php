@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Replenish Stock for {{ $sparePart->name }}</h2>
    <form action="{{ route('mechanic.spare_parts.replenish') }}" method="post">
        @csrf
        <input type="hidden" name="part_id" value="{{ $sparePart->id }}">
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Replenish Stock</button>
    </form>
</div>
@endsection
