@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Members List</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.members.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Member</a>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">ID</th>
            <th class="border p-2">Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Phone</th>
            <th class="border p-2">Active</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr>
            <td class="border p-2">{{ $member->id }}</td>
            <td class="border p-2">{{ $member->name }}</td>
            <td class="border p-2">{{ $member->email }}</td>
            <td class="border p-2">{{ $member->phone }}</td>
            <td class="border p-2">
                <form action="{{ route('admin.members.toggle-active', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-2 py-1 rounded {{ $member->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                    </button>
                </form>
            </td>
            <td class="border p-2 space-x-2">
                <a href="{{ route('admin.members.edit', $member->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $members->links() }}
</div>
@endsection
