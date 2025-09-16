@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Borrow Transactions</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.borrows.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Borrow</a>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border p-2">ID</th>
            <th class="border p-2">Member</th>
            <th class="border p-2">Book</th>
            <th class="border p-2">Borrow Date</th>
            <th class="border p-2">Due Date</th>
            <th class="border p-2">Return Date</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $borrow)
        <tr>
            <td class="border p-2">{{ $borrow->id }}</td>
            <td class="border p-2">{{ $borrow->member->name }}</td>
            <td class="border p-2">{{ $borrow->book->title }}</td>
            <td class="border p-2">{{ $borrow->borrow_date->format('Y-m-d') }}</td>
            <td class="border p-2">{{ $borrow->due_date->format('Y-m-d') }}</td>
            <td class="border p-2">{{ $borrow->return_date?->format('Y-m-d') ?? '-' }}</td>
            <td class="border p-2">
                @if($borrow->return_date)
                    <span class="bg-green-500 text-white px-2 py-1 rounded">Returned</span>
                @else
                    <span class="bg-yellow-500 text-white px-2 py-1 rounded">Active</span>
                @endif
            </td>
            <td class="border p-2 space-x-2">
                @if(!$borrow->return_date)
                    <form action="{{ route('admin.borrows.return', $borrow->id) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded" onclick="return confirm('Mark book as returned?')">Return</button>
                    </form>
                @endif
                <form action="{{ route('admin.borrows.destroy', $borrow->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Delete this borrow record?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $borrows->links() }}
</div>
@endsection
