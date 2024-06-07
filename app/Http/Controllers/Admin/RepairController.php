<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class RepairController extends Controller
{
    // ... existing methods ...

    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'mechanic') {
            $repairs = Repair::where('mechanic_id', $user->id)->get();
        } elseif ($user->role === 'client') {
            $repairs = Repair::where('client_id', $user->id)->get();
        } else {
            $repairs = Repair::all();
        }
        
        return view('admin.repairs.index', compact('repairs'));
    }

    public function create()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        $mechanics = User::where('role', 'mechanic')->get();
        
        return view('admin.repairs.create', compact('clients', 'vehicles', 'mechanics'));
    }

    public function store(Request $request)
    {
        Log::info('Form Data: ', $request->all());

        $request->validate([
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
            'start_date' => 'required|date',
            'mechanic_id' => 'required|exists:users,id,role,mechanic',
            'vehicle_id' => 'required|exists:vehicles,id',
            'client_id' => 'required|exists:clients,id',
        ]);

        $repair = new Repair($request->all());
        $repair->save();

        Log::info('Repair Saved: ', $repair->toArray());

        return redirect()->route('admin.vehicles.repairs', $repair->vehicle_id)->with('success', 'Repair created successfully');
    }

    public function show(Repair $repair)
    {
        $user = auth()->user();
        
        if ($user->role === 'mechanic' && $repair->mechanic_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.repairs.show', compact('repair'));
    }

    public function edit(Repair $repair)
    {
        $user = auth()->user();
        
        if ($user->role === 'mechanic' && $repair->mechanic_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $clients = Client::all();
        $vehicles = Vehicle::all();
        $mechanics = User::where('role', 'mechanic')->get();
        
        return view('admin.repairs.edit', compact('repair', 'clients', 'vehicles', 'mechanics'));
    }

    public function update(Request $request, Repair $repair)
    {
        $user = auth()->user();
    
        if ($user->role === 'mechanic' && $repair->mechanic_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
            'start_date' => 'required|date',
            'mechanic_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'client_id' => 'required|exists:clients,id', // Changed to 'clients' table
        ]);
    
        $repair->update($request->all());
    
        return redirect()->route('admin.vehicles.repairs', $repair->vehicle_id)->with('success', 'Repair updated successfully');
    }

    public function destroy(Repair $repair)
    {
        $user = auth()->user();
        
        if ($user->role === 'mechanic' && $repair->mechanic_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        } elseif ($user->role === 'client' && $repair->client_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $repair->delete();
        
        return redirect()->route('admin.vehicles.repairs', $repair->vehicle_id)->with('success', 'Repair deleted successfully');
    }
}
