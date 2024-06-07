<!-- resources/views/admin/spare_parts/replenish.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Replenish Spare Part</h1>
        <form action="{{ route('admin.spare_parts.replenish_stock', $sparePart->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Replenish</button>
        </form>
    </div>
@endsection
