
@extends('layouts.app')

@section('content')
<h1>Create New Address Book Entry</h1>
<form action="{{ route('addressbook.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>

    <button type="submit">Add Entry</button>
</form>
@endsection