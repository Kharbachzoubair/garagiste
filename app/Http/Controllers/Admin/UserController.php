<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Add New User
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:client,mechanic',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            // Add more fields as needed
        ]);

        // Create a new user
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->address = $validatedData['address'];
        $user->phone = $validatedData['phone'];
        // Set other user attributes
        $user->save();

        return redirect('/users')->with('success', 'User created successfully!');
    }

    // View List of Users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Update User Information
    public function update(Request $request, User $user)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:client,mechanic',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            // Add more fields as needed
        ]);

        // Update user information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->address = $validatedData['address'];
        $user->phone = $validatedData['phone'];
        // Update other user attributes
        $user->save();

        return redirect('/users')->with('success', 'User updated successfully!');
    }

    // Delete User Account
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User deleted successfully!');
    }
}
