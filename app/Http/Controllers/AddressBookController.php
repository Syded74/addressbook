<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    public function index()
    {
        $entries = AddressBook::all();
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
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $addressBook->file_path = $request->file('file')->store('public/addressbook_files');
        }
        $addressBook->save();

        return redirect()->route('addressbook.index')->with('success', 'Entry created successfully!');
    }

    public function show(AddressBook $addressBook)
    {
        return view('addressbook.show', compact('addressBook'));
    }
    public function edit($id)
    {
        $addressBook = AddressBook::findOrFail($id);
        return view('addressbook.edit', compact('addressBook'));
    }
    

    public function update(Request $request, AddressBook $addressBook)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240', // Max file size 10 MB
        ]);

        try {
            DB::transaction(function () use ($validated, $request, $addressBook) {
                if ($request->hasFile('file') && $request->file('file')->isValid()) {
                    Storage::delete($addressBook->file_path);
                    $addressBook->file_path = $request->file('file')->store('public/addressbook_files');
                }
                $addressBook->update($validated);
            });

            return redirect()->route('addressbook.index')->with('success', 'Entry updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update address book entry', ['error' => $e->getMessage()]);
            return back()->withErrors('Failed to update entry: ' . $e->getMessage());
        }
    }

    public function destroy(AddressBook $addressBook)
    {
        try {
            if ($addressBook->file_path && Storage::exists($addressBook->file_path)) {
                Storage::delete($addressBook->file_path);
            }
            $addressBook->delete();

            return redirect()->route('addressbook.index')->with('success', 'Entry deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete address book entry', ['error' => $e->getMessage()]);
            return back()->withErrors('Failed to delete entry: ' . $e->getMessage());
        }
    }
}
