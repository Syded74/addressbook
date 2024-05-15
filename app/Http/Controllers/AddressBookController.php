<?php

namespace App\Http\Controllers;

use App\Models\AddressBook; 
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = AddressBook::all(); 
        return view('addressbook.index', compact('entries')); 
    }

    /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('addressbook.create');
}
                                                                                             

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        AddressBook::create($validated);

        return redirect()->route('addressbook.index')->with('success', 'Entry created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  AddressBook $addressBook
     * @return \Illuminate\Http\Response
     */
    public function show(AddressBook $addressBook)
    {
        return view('addressbook.show', compact('addressBook')); // Pass the entry to the show view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AddressBook $addressBook
     * @return \Illuminate\Http\Response
     */
    public function edit(AddressBook $addressBook)
    {
        return view('addressbook.edit', compact('addressBook')); // Show the edit form with the entry
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AddressBook $addressBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddressBook $addressBook)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $addressBook->update($validated); // Update the entry with validated data

        return redirect()->route('addressbook.index')->with('success', 'Entry updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AddressBook $addressBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressBook $addressBook)
    {
        $addressBook->delete(); 
        return redirect()->route('addressbook.index')->with('success', 'Entry deleted successfully!');
    }
}
