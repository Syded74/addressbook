
@extends('layouts.app')

@section('content')
<h1>Create New Address Book Entry</h1>
<form action="{{ route('addressbook.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>

    <!-- File Upload -->
    <label for="file">Upload a file:</label>
    <input type="file" name="file" id="file">
    

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <button type="submit">Add Entry</button>
</form>
@endsection
    
