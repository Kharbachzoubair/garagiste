<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'client', // Assign the role 'client' directly for users registering through this form
            ]);

            // Log user creation
            Log::info('User created successfully', ['user' => $user]);

            // Check if the user was successfully created
            if (!$user) {
                throw new \Exception('Failed to create user.');
            }

            // Create the client associated with the user (using user's email)
            $client = Client::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'user_id' => $user->id,
                'email' => $request->email,
            ]);

            // Log client creation
            Log::info('Client created successfully', ['client' => $client]);

            // Check if the client was successfully created
            if (!$client) {
                throw new \Exception('Failed to create client.');
            }

            // Fire the Registered event
            event(new Registered($user));

            return redirect(route('client.dashboard', [], false));
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Exception during registration: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }
}
