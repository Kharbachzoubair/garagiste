@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">Create Invoice</a>
    <a href="{{ route('admin.invoices.export.csv') }}" class="btn btn-success">Export Invoices</a>
    <a href="{{ route('admin.invoices.import.view') }}" class="btn btn-warning">Import Invoices</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Repair ID</th>
                <th>Additional Charges</th>
                <th>Total Amount</th>
                <th>Approved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->repair->id }}</td>
                    <td>{{ $invoice->additional_charges }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                    <td>{{ $invoice->approved ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-info">Show</a>
                        @if (!$invoice->approved)
                            <form action="{{ route('admin.invoices.approve', $invoice) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
