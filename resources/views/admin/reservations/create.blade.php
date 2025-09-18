@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Create Reservation</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reservations.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf

        <!-- Select Member -->
        <div>
            <label for="member_id" class="block font-medium">Member</label>
            <select name="member_id" id="member_id" required
                    class="w-full border-gray-300 rounded-lg px-3 py-2">
                <option value="">-- Select Member --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
                @endforeach
            </select>
        </div>

        <!-- Select Book -->
        <div>
            <label for="book_id" class="block font-medium">Book</label>
            <select name="book_id" id="book_id" required
                    class="w-full border-gray-300 rounded-lg px-3 py-2">
                <option value="">-- Select Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} by {{ $book->author }}</option>
                @endforeach
            </select>
        </div>

        <!-- Reservation Date -->
        <div>
            <label for="reservation_date" class="block font-medium">Reservation Date & Time</label>
            <input type="datetime-local" name="reservation_date" id="reservation_date" required
                value="{{ old('reservation_date', now()->format('Y-m-d\TH:i')) }}"
                class="w-full border-gray-300 rounded-lg px-3 py-2">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" required
                    class="w-full border-gray-300 rounded-lg px-3 py-2">
                <option value="pending">Pending</option>
                <option value="picked_up">Picked Up</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Save Reservation
        </button>
        <a href="{{ route('admin.reservations.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            Cancel
        </a>
    </form>
@endsection
