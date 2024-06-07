@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px;">
    <h1 style="color: #333;">Users</h1>
    <a href="{{ route('users.create') }}" class="btn" style="background-color: #28a745;">Add New User</a>
    <table class="table" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; padding: 8px;">Name</th>
                <th style="text-align: left; padding: 8px;">Email</th>
                <th style="text-align: left; padding: 8px;">Address Books Count</th>
                <th style="text-align: left; padding: 8px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->name }}</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->email }}</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $user->address_book_entries_count }}</td>
                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn" style="background-color: #007bff; margin-right: 5px;">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background-color: #dc3545;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
