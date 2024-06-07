<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientVehicleController extends Controller
{
    public function index()
    {
        $vehicles = Auth::user()->client->vehicles;
        return view('client.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('client.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|in:gasoline,diesel,hybrid',
            'registration' => 'required|string|max:255|unique:vehicles,registration',
            'photos' => 'nullable|string',
        ]);

        $client = Auth::user()->client;
        $client->vehicles()->create($request->all());

        return redirect()->route('client.vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);
        return view('client.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);

        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|in:gasoline,diesel,hybrid',
            'registration' => 'required|string|max:255|unique:vehicles,registration,' . $vehicle->id,
            'photos' => 'nullable|string',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('client.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return redirect()->route('client.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}