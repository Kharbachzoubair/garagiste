<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Repair;
use Illuminate\Support\Facades\Auth;

class ClientRepairController extends Controller
{
    public function index()
    {
        $client = Auth::user()->client;
        $repairs = Repair::where('client_id', $client->id)->with('vehicle', 'mechanic')->get();
        return view('client.repairs.index', compact('repairs'));
    }
}