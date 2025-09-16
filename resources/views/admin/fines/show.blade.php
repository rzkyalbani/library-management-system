@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">💰 Fine Detail</h2>

    <div class="mb-4">
        <p><strong>Member:</strong> {{ $fine->borrow->member->name }} ({{ $fine->borrow->member->email }})</p>
        <p><strong>Book:</strong> {{ $fine->borrow->book->title }} by {{ $fine->borrow->book->author }}</p>
        <p><strong>Borrow Date:</strong> {{ $fine->borrow->borrow_date->format('d M Y') }}</p>
        <p><strong>Due Date:</strong> {{ $fine->borrow->due_date->format('d M Y') }}</p>
        <p><strong>Return Date:</strong> 
            {{ $fine->borrow->return_date ? $fine->borrow->return_date->format('d M Y') : 'Not Returned' }}
        </p>
        <p><strong>Fine Amount:</strong> Rp {{ number_format($fine->amount, 0, ',', '.') }}</p>
        <p><strong>Fine Date:</strong> {{ $fine->fine_date->format('d M Y') }}</p>
        <p><strong>Status:</strong> 
            @if($fine->is_paid)
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded">Paid</span>
            @else
                <span class="px-2 py-1 bg-red-100 text-red-800 rounded">Unpaid</span>
            @endif
        </p>
    </div>

    <div class="flex space-x-2">
        @if(!$fine->is_paid)
            <form method="POST" action="{{ route('admin.fines.markAsPaid', $fine) }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Mark as Paid
                </button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.fines.destroy', $fine) }}" 
              onsubmit="return confirm('Are you sure you want to delete this fine?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Delete
            </button>
        </form>

        <a href="{{ route('admin.fines.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
           Back to List
        </a>
    </div>
</div>
@endsection
