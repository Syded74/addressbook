@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <!-- Status selection -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ $user->status == 'active' ? ' selected' : '' }}>Active</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? ' selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
