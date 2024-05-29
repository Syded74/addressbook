@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Address Book Entries</h1>
    <div class="mb-4">
        <a href="{{ route('addressbook.create') }}" class="btn btn-primary">Add New Entry</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($entries->isEmpty())
        <div class="alert alert-warning">No entries found. Add a new entry!</div>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
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
                        <a href="{{ route('addressbook.show', $entry->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('addressbook.edit', $entry->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('addressbook.destroy', $entry->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>        
                    </td>
                </tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
