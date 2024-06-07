@extends('layouts.master')

@section('content')
    <h1>Invoice Report</h1>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Repair ID</th>
                <th>Client Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Approved</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->repair_id }}</td>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->approved ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
