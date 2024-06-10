<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Include the Hash facade

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User ::query();
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');

    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('date')) {
        $query->where('created_at', $request->date);
    }

    $users = $query ->withCount('addressBookEntries')->paginate(10);

   // $users = User::withCount('addressBookEntries')->get();
    return view('users.index', compact('users'));
}


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'status' => 'required|in:active,inactive'
        ]);
    
        $validatedData['password'] = Hash::make($validatedData['password']); // Hash the password
        User::create($validatedData);
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }
                                                                                                                                                                                                                                                                                
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));                                                                                                                                                                                             
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:active,inactive'
        ]);
    
        $user = User::findOrFail($id);
        $user->update($validated);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
