
@extends('layouts.app')

@section('content')
<h1>Edit Entry</h1>
<form action="{{ route('addressbook.update', $addressBook->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ old('name', $addressBook->name) }}" required>
    <input type="text" name="address" value="{{ old('address', $addressBook->address) }}" required>
    <input type="text" name="phone" value="{{ old('phone', $addressBook->phone) }}" required>
    <button type="submit">Update Entry</button>
</form>
                                                                 
@endsection
