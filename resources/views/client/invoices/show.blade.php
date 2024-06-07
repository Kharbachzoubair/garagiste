@extends('layouts.master')

@section('content')
<h1>Invoice Details</h1>
<table>
    <tr>
        <th>Repair Description</th>
        <td>{{ $invoice->repair->description }}</td>
    </tr>
    <tr>
        <th>Total Amount</th>
        <td>{{ $invoice->total_amount }}</td>
    </tr>
    <tr>
        <th>Additional Charges</th>
        <td>{{ $invoice->additional_charges }}</td>
    </tr>
</table>
@endsection
