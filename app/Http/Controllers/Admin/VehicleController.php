<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\SparePart;
use App\Models\Client;
use App\Models\User; // Add this line
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $clients = Client::all(); // Assuming you want to fetch all clients from the database.
        
        return view('admin.vehicles.create')->with('clients', $clients);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'registration' => 'required|string|max:255|unique:vehicles,registration',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('car_images', 'public');
            $validated['photo'] = $imagePath;
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function showRepairs($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);
        $repairs = Repair::where('vehicle_id', $vehicle->id)->get();
    
        return view('admin.vehicles.repairs', compact('vehicle', 'repairs'));
    }
    
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $clients = Client::all();
        return view('admin.vehicles.edit', compact('vehicle', 'clients'));
    }
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'registration' => 'required|string|max:255|unique:vehicles,registration,' . $vehicle->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'client_id' => 'required|exists:clients,id',
        ]);
    
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('car_images', 'public');
            $validated['photo'] = $imagePath;
        }
    
        $vehicle->update($validated);
    
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
    
  
}
