@extends('layouts.app')

@section('content')
<h1>Create New Address Book Entry</h1>
<form action="{{ route('addressbook.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>
    </div>
    <div>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
    </div>
    <div>
        <!-- File Upload -->
        <label for="file">Upload an Image:</label>
        <input type="file" name="file" id="file">
    </div>

    <button type="submit">Add Entry</button>
</form>
@endsection
