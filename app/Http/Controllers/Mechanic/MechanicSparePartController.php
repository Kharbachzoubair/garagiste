<?php
namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\SparePart;
use Illuminate\Http\Request;

class MechanicSparePartController extends Controller
{
    public function index()
    {
        $spareParts = SparePart::all();
        return view('mechanic.spare_parts.index', compact('spareParts'));
    }

    public function create()
    {
        return view('mechanic.spare_parts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'part_name' => 'required|string',
            'part_reference' => 'required|string|unique:spare_parts,part_reference',
            'supplier' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        SparePart::create($request->all());

        return redirect()->route('mechanic.spare_parts.index')->with('success', 'Spare part created successfully.');
    }

    public function edit(SparePart $sparePart)
    {
        return view('mechanic.spare_parts.edit', compact('sparePart'));
    }

    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'part_name' => 'required|string',
            'part_reference' => 'required|string|unique:spare_parts,part_reference,' . $sparePart->id,
            'supplier' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $sparePart->update($request->all());

        return redirect()->route('mechanic.spare_parts.index')->with('success', 'Spare part updated successfully.');
    }

    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();

        return redirect()->route('mechanic.spare_parts.index')->with('success', 'Spare part deleted successfully.');
    }
}
