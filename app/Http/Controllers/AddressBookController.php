<?php

namespace App\Http\Controllers;

use App\Models\AddressBook;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
{-
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'file' => 'nullable|file|max:10240', 
    ]);       

    $addressBook = new AddressBook($validated);
    $addressBook->user_id = auth()->id(); 
    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $addressBook->file_path = $request->file('file')->store('public/addressbook_files');
    }
    $addressBook->save(); 

    return redirect()->route('addressbook.index')->with('success', 'Entry created successfully!');
}
    public function show($id)
     
    {
        

        $addressBook = AddressBook::findOrFail($id);
        //dd($addressBook);
        return view('addressbook.show', compact('addressBook'));
    }
    public function edit($id)
    {
        $addressBook = AddressBook::findOrFail($id);
        return view('addressbook.edit', compact('addressBook'));
    }
    

    public function update(Request $request, $id)
    {
        Log::info('Received data:', ['data' => $request->all()]);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240', // Optional, max size 10MB
        ]);
    
        Log::info('Validated data:', ['validated' => $validated]);
    
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = $request->file('file')->store('public/addressbook_files');
            $validated['file_path'] = $filePath;
            Log::info('File path:', ['file_path' => $filePath]);
        }
    
        $addressBook = AddressBook::findOrFail($id);
        $addressBook->update($validated);
    
        return redirect()->route('addressbook.index')->with('success', 'Entry updated successfully!');
    }
    
                                

    public function destroy($id)
{
    try {
        $addressBook = AddressBook::findOrFail($id);

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
