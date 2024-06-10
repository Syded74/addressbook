@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px;">
    <h1 style="color: #333;">Users</h1>
    <a href="{{ route('users.create') }}" class="btn" style="background-color: #28a745;">Add New User</a>
    <table class="table" style="width: 100%; border-collapse: collapse;">

  <!-- Filter Form -->
  <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" name="name" placeholder="Search by name" value="{{ request('name') }}">
            </div>
            <div class="col">
                <select class="form-control" name="status">
                    <option value="">Select Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col">
                <input type="date" class="form-control" name="date" value="{{ request('date') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">Filter</button>
            </div>
        </div>
    </form>
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
