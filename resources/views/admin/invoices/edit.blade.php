@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Edit Invoice</div>

                    <div class="card-body">
                        <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="repair_id">Repair</label>
                                <select name="repair_id" id="repair_id" class="form-control @error('repair_id') is-invalid @enderror" required autocomplete="repair_id">
                                    @foreach ($repairs as $repair)
                                        <option value="{{ $repair->id }}" {{ old('repair_id', $invoice->repair_id) == $repair->id ? 'selected' : '' }}>{{ $repair->description }}</option>
                                    @endforeach
                                </select>
                                @error('repair_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="additional_charges">Additional Charges</label>
                                <input type="number" name="additional_charges" id="additional_charges" class="form-control @error('additional_charges') is-invalid @enderror" value="{{ old('additional_charges', $invoice->additional_charges) }}" autocomplete="additional_charges">
                                @error('additional_charges')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input type="number" name="total_amount" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" value="{{ old('total_amount', $invoice->total_amount) }}" required autocomplete="total_amount">
                                @error('total_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Invoice</button>
                                <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
