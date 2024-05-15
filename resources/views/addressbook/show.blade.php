@extends('layouts.app')

@section('content')
    <h1>View Entry</h1>
    <p><strong>Name:</strong> {{ $addressBook->name }}</p>
    <p><strong>Address:</strong> {{ $addressBook->address }}</p>
    <p><strong>Phone:</strong> {{ $addressBook->phone }}</p>
    <a href="{{ route('addressbook.index') }}">Back to list</a>
@endsection
