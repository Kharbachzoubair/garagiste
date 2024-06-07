@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Edit Repair</div>

                    <div class="card-body">
                        <form action="{{ route('admin.repairs.update', $repair->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $repair->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }} </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vehicle_id">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror" required>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $repair->vehicle_id) == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->make }} {{ $vehicle->model }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mechanic_id">Mechanic</label>
                                <select name="mechanic_id" id="mechanic_id" class="form-control @error('mechanic_id') is-invalid @enderror" required>
                                    @foreach ($mechanics as $mechanic)
                                        <option value="{{ $mechanic->id }}" {{ old('mechanic_id', $repair->mechanic_id) == $mechanic->id ? 'selected' : '' }}>{{ $mechanic->name }}</option>
                                    @endforeach
                                </select>
                                @error('mechanic_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $repair->start_date) }}" required autocomplete="start_date">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $repair->end_date) }}" autocomplete="end_date">
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required autocomplete="description">{{ old('description', $repair->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $repair->cost) }}" required autocomplete="cost">
                                @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status', $repair->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status', $repair->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="in_progress" {{ old('status', $repair->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="cancelled" {{ old('status', $repair->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Repair</button>
                                <a href="{{ route('admin.repairs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
