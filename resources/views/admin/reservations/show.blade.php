@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Reservation Detail</h2>

    <div class="bg-white shadow rounded-lg p-6">
        <p><strong>ID:</strong> {{ $reservation->id }}</p>
        <p><strong>Member:</strong> {{ $reservation->member->name }} ({{ $reservation->member->email }})</p>
        <p><strong>Book:</strong> {{ $reservation->book->title }} by {{ $reservation->book->author }}</p>
        <p><strong>Reservation Date:</strong> {{ $reservation->reservation_date }}</p>
        <p><strong>Expiration Date:</strong> {{ $reservation->exp_date }}</p>
        <p><strong>Status:</strong> 
            <span class="px-2 py-1 rounded text-white 
                @if($reservation->status === 'pending') bg-yellow-500 
                @elseif($reservation->status === 'picked_up') bg-green-600 
                @else bg-red-600 @endif">
                {{ ucfirst($reservation->status) }}
            </span>
        </p>
    </div>

    <div class="mt-4 flex gap-2">
        <a href="{{ route('admin.reservations.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this reservation?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Delete
            </button>
        </form>
    </div>
@endsection
