<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    public function index(Request $request)
    {
        $query = AddressBook::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');

        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->where('created_at', $request->date);
        }

        $entries = $query->get();
           /*
        $entries = AddressBook::with('user')->get();
        */
        return view('addressbook.index', compact('entries'));
        
    }

    public function create()
    {
        return view('addressbook.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240', // Up to 10 MB
        ]);

        $addressBook = new AddressBook($validated);
        $addressBook->user_id = auth()->id(); // Assuming you have authentication and 'user_id' is in your table

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $addressBook->file_path = $request->file('file')->store('public/addressbook_files');
        }
        
        $addressBook->save();
        Log::info('New Address Book Entry:', ['id' => $addressBook->id]); // For debugging

        return redirect()->route('addressbook.index')->with('success', 'Entry created successfully!');
    }

    public function show($id)
    {
        $addressBook = AddressBook::findOrFail($id);
        return view('addressbook.show', compact('addressBook'));
    }

    public function edit($id)
    {
        $addressBook = AddressBook::findOrFail($id);
        return view('addressbook.edit', compact('addressBook'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240', // Optional, max size 10MB
        ]);

        $addressBook = AddressBook::findOrFail($id);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            Storage::delete($addressBook->file_path);
            $filePath = $request->file('file')->store('public/addressbook_files');
            $validated['file_path'] = $filePath;
        }

        $addressBook->update($validated);
        Log::info('Updated Address Book Entry:', ['id' => $addressBook->id]); // For debugging

        return redirect()->route('addressbook.index')->with('success', 'Entry updated successfully!');
    }

    public function destroy($id)
    {
        $addressBook = AddressBook::findOrFail($id);
        if ($addressBook->file_path && Storage::exists($addressBook->file_path)) {
            Storage::delete($addressBook->file_path);
        }
        $addressBook->delete();

        return redirect()->route('addressbook.index')->with('success', 'Entry deleted successfully!');
    }
}
