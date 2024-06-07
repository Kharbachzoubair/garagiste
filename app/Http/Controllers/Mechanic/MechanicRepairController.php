<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MechanicRepairController extends Controller
{
    public function index()
    {
        $repairs = Repair::where('mechanic_id', Auth::id())->with('vehicle', 'client')->get();
        return view('mechanic.repairs.index', compact('repairs'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('mechanic.repairs.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string|in:pending,ongoing,completed',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'vehicle_id' => 'required|exists:vehicles,id',
            'client_id' => 'required|exists:clients,id',
        ]);

        Repair::create([
            'mechanic_id' => Auth::id(),
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vehicle_id' => $request->vehicle_id,
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('mechanic.repairs.index')->with('success', 'Repair created successfully.');
    }

    public function edit(Repair $repair)
    {
        $this->authorize('update', $repair);

        $vehicles = Vehicle::all();
        return view('mechanic.repairs.edit', compact('repair', 'vehicles'));
    }

    public function update(Request $request, Repair $repair)
    {
        $this->authorize('update', $repair);

        $request->validate([
            'status' => 'required|string|in:pending,ongoing,completed',
        ]);

        $repair->update(['status' => $request->status]);

        return redirect()->route('mechanic.repairs.index')->with('success', 'Repair status updated successfully.');
    }

    public function destroy(Repair $repair)
    {
        $this->authorize('delete', $repair);

        $repair->delete();

        return redirect()->route('mechanic.repairs.index')->with('success', 'Repair deleted successfully.');
    }

    public function updateStatus(Request $request, Repair $repair)
    {
        $this->authorize('update', $repair);

        $request->validate([
            'status' => 'required|string|in:pending,ongoing,completed',
        ]);

        $repair->update(['status' => $request->status]);

        return redirect()->route('mechanic.repairs.index')->with('success', 'Repair status updated successfully.');
    }
}
