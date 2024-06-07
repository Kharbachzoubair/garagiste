<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;
use App\Models\Invoice;


class ClientInvoiceController extends Controller
{
    public function index()
    {
        $client = Auth::user()->client;
        $invoices = Invoice::whereHas('repair', function ($query) use ($client) {
            $query->where('client_id', $client->id);
        })->with('repair')->get();
        return view('client.invoices.index', compact('invoices'));
    }
}