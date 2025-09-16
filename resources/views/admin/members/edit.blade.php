@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Member</h1>

<form action="{{ route('admin.members.update', $member->id) }}" method="POST">
    @method('PUT')
    @include('admin.members._form')
</form>
@endsection
