<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SparePart;

class ClientSparePartController extends Controller
{
    public function index()
    {
        // Get all spare parts for the current client
        $spareParts = SparePart::where('client_id', auth()->id())->get();
        return view('client.spare_parts.index', compact('spareParts'));
    }

    public function show(SparePart $sparePart)
    {
        // Make sure the spare part belongs to the current client
        if ($sparePart->client_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.spare_parts.show', compact('sparePart'));
    }
}
