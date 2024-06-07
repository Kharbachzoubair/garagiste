@extends('layouts.master')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Spare Part</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.spare_parts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="repair_id" value="{{ $repair->id }}">

                <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" name="part_name" id="part_name" class="form-control @error('part_name') is-invalid @enderror" value="{{ old('part_name') }}" required>
                    @error('part_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="part_reference">Part Reference</label>
                    <input type="text" name="part_reference" id="part_reference" class="form-control @error('part_reference') is-invalid @enderror" value="{{ old('part_reference') }}" required>
                    @error('part_reference')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" name="supplier" id="supplier" class="form-control @error('supplier') is-invalid @enderror" value="{{ old('supplier') }}" required>
                    @error('supplier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Spare Part</button>
            </form>
        </div>
    </div>

@endsection
