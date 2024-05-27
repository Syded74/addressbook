@extends('layouts.app')

@section('content')
<h1>Address Book Entries</h1>
<a href="{{ route('addressbook.create') }}">Add New Entry</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entries as $entry)
        <tr>
            <td>{{ $entry->name }}</td>
            <td>{{ $entry->address }}</td>
            <td>{{ $entry->phone }}</td>
            <td>
                @if ($entry->file_path)
                    <a href="{{ Storage::url($entry->file_path) }}" target="_blank">
                        <img src="{{ Storage::url($entry->file_path) }}" alt="file image" style="width: 100px; height: auto;">
                    </a>
                @else
                    No file uploaded
                @endif
            </td>
            <td>
                <a href="{{ route('addressbook.show', $entry->id) }}">View</a>
                <a href="{{ route('addressbook.edit', $entry->id) }}">Edit</a>
                <form action="{{ route('addressbook.destroy', $entry->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>