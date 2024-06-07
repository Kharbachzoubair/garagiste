@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Invoice</h1>
    <form action="{{ route('admin.invoices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="repair_id">Repair</label>
            <select name="repair_id" id="repair_id" class="form-control" required>
                @foreach($repairs as $repair)
                    <option value="{{ $repair->id }}">{{ $repair->client_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="additional_charges">Additional Charges</label>
            <input type="number" name="additional_charges" id="additional_charges" class="form-control">
        </div>
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
