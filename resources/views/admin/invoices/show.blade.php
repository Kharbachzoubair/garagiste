@extends('layouts.master')

@section('content')
    <h1>Invoice Details</h1>
    <p>Invoice ID: {{ $invoice->id }}</p>
    <p>Repair ID: {{ $invoice->repair_id }}</p>
    <p>Client Name: {{ $invoice->client_name }}</p>
    <p>Amount: {{ $invoice->amount }}</p>
    <p>Status: {{ $invoice->status }}</p>
@endsection