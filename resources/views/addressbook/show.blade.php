@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>View Entry</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $addressBook->name }}</p>
            <p><strong>Address:</strong> {{ $addressBook->address }}</p>
            <p><strong>Phone:</strong> {{ $addressBook->phone }}</p>
            @if ($addressBook->file_path)
                <p><strong>File:</strong> <a href="{{ Storage::url($addressBook->file_path) }}" target="_blank">Download</a></p>
            @endif
        </div>
    </div>
    <a href="{{ route('addressbook.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
