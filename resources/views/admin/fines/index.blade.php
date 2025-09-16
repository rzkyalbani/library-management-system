@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold">💰 Fines Management</h2>

    <!-- Filter -->
    <div>
        <a href="{{ route('admin.fines.index') }}" 
           class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">All</a>
        <a href="{{ route('admin.fines.index', ['status' => 'unpaid']) }}" 
           class="px-3 py-1 bg-red-200 rounded hover:bg-red-300">Unpaid</a>
        <a href="{{ route('admin.fines.index', ['status' => 'paid']) }}" 
           class="px-3 py-1 bg-green-200 rounded hover:bg-green-300">Paid</a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($fines->count())
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">#</th>
                    <th class="p-3">Member</th>
                    <th class="p-3">Book</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Fine Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fines as $fine)
                    <tr class="border-b">
                        <td class="p-3">{{ $fine->id }}</td>
                        <td class="p-3">{{ $fine->borrow->member->name }}</td>
                        <td class="p-3">{{ $fine->borrow->book->title }}</td>
                        <td class="p-3">Rp {{ number_format($fine->amount, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $fine->fine_date->format('d M Y') }}</td>
                        <td class="p-3">
                            @if($fine->is_paid)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Paid</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded">Unpaid</span>
                            @endif
                        </td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('admin.fines.show', $fine) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                View
                            </a>
                            @if(!$fine->is_paid)
                                <form method="POST" action="{{ route('admin.fines.markAsPaid', $fine) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Mark as Paid
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.fines.destroy', $fine) }}" 
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $fines->links() }}
    </div>
@else
    <p class="text-gray-600">No fines found.</p>
@endif
@endsection
