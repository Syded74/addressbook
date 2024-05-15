
@extends('layouts.app')

@section('content')
<h1>Edit Entry</h1>
<form action="{{ route('addressbook.update', $entry->id) }}" method="POST">
    @method('PUT')
    @include('addressbook.form')
</form>
@endsection
