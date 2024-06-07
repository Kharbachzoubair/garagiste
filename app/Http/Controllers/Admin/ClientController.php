<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            $clients = Client::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->get();

            return response()->json($clients);
        }

        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
   /**
 * Store a newly created client in storage.
 *//**
 * Store a newly created client in storage.
 */
public function store(Request $request): RedirectResponse
{
    // Validate client data
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'phone_number' => ['nullable', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'], // Assuming you have a password field in the request
    ]);

    // Create a new user with the client role
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'client', // Assuming 'role' is a column in your users table
    ]);

    // Create the client
    $client = Client::create([
        'name' => $validatedData['name'],
        'address' => $validatedData['address'],
        'phone_number' => $validatedData['phone_number'],
        'email' => $validatedData['email'],
        'user_id' => $user->id, // Assuming you want to associate the user ID with the client
    ]);

    return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
}

/**
 * Generate a unique name for the client.
 *
 * @param string $name
 * @return string
 */




    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients,email,' . $client->id],
        ]);

        $client->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        // Update the linked user's email with the client's email
        if ($client->user) {
            $client->user->update(['email' => $client->email]);
        }

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }


    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        // Delete the corresponding user with the role 'client'
        if ($client->user) {
            $client->user->delete();
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }

    /**
     * Generate a unique name for the client.
     *
     * @param string $name
     * @return string
     */
    private function generateUniqueName($name)
    {
        $count = Client::where('name', $name)->count();
        if ($count > 0) {
            return $name . '_' . ($count + 1); // Append a unique identifier
        }
        return $name;
    }
}
