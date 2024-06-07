<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SparePart;
use App\Models\Repair;

class SparePartController extends Controller
{
    public function index()
    {
        $spareParts = SparePart::all();
        return view('admin.spare_parts.index', compact('spareParts'));
    }

    public function create($repair_id)
    {
        // Fetch the repair to pre-fill any form, etc.
        $repair = Repair::findOrFail($repair_id);
        return view('admin.spare_parts.create', compact('repair'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'part_name' => 'required|string|max:255',
            'part_reference' => 'required|string|max:255|unique:spare_parts,part_reference',
            'supplier' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Create spare part
        $sparePart = SparePart::create($request->all());

        // Get the vehicle ID from the repair
        $repair = $sparePart->repair;
        $vehicleId = $repair->vehicle_id;

        // Redirect to the repairs of the vehicle
        return redirect()->route('admin.vehicles.repairs', ['id' => $vehicleId])
                         ->with('success', 'Spare part created successfully.');
    }

    public function edit(SparePart $sparePart)
    {
        return view('admin.spare_parts.edit', compact('sparePart'));
    }

    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'part_name' => 'required|string|max:255',
            'part_reference' => 'required|string|max:255|unique:spare_parts,part_reference,' . $sparePart->id,
            'supplier' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $sparePart->update($request->all());

        // Get the vehicle ID from the repair
        $repair = $sparePart->repair;
        $vehicleId = $repair->vehicle_id;

        // Redirect to the repairs of the vehicle
        return redirect()->route('admin.vehicles.repairs', ['id' => $vehicleId])
                         ->with('success', 'Spare part updated successfully.');
    }

    public function destroy(SparePart $spare_part)
    {
        // Get the vehicle ID from the repair before deleting the spare part
        $vehicleId = $spare_part->repair->vehicle_id;
        
        $spare_part->delete();

        return redirect()->route('admin.vehicles.repairs', ['id' => $vehicleId])
                         ->with('success', 'Spare part deleted successfully');
    }
}
