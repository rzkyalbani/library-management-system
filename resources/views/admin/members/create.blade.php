@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Add New Member</h1>

<form action="{{ route('admin.members.store') }}" method="POST">
    @include('admin.members._form')
</form>
@endsection
