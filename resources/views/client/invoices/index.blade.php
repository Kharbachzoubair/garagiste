@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Your Invoices</h5>
        </div>
        <div class="card-body">
            @if ($invoices->isEmpty())
                <p>You have no invoices available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Repair</th>
                                <th>Additional Charges</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->repair->description }}</td>
                                    <td>{{ $invoice->additional_charges }}</td>
                                    <td>{{ $invoice->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('client.invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
