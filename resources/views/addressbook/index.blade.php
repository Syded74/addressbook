@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Address Book Entries</h1>
    <a href="{{ route('addressbook.create') }}" class="btn btn-primary mb-3">Add New Entry</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Profile Picture</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Added by</th> <!-- Added this new column -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>
                    @if ($entry->file_path)
                        <img src="{{ Storage::url($entry->file_path) }}" alt="Profile Picture" style="width: 100px; height: 100px;">
                    @else
                        No picture
                    @endif
                </td>
                <td>{{ $entry->name }}</td>
                <td>{{ $entry->address }}</td>
                <td>{{ $entry->phone }}</td>
                <td>{{ $entry->user->name ?? 'Unknown' }}</td> <!-- Display the user who added the entry -->
                <td>
                    <a href="{{ route('addressbook.show', $entry->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('addressbook.edit', $entry->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('addressbook.destroy', $entry->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
