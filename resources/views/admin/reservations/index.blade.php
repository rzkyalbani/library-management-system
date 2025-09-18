@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Reservations</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.reservations.create') }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Add Reservation
            </a>
        </div>

        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Member</th>
                    <th class="px-4 py-2">Book</th>
                    <th class="px-4 py-2">Reservation Date</th>
                    <th class="px-4 py-2">Expiration Date</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $reservation->id }}</td>
                        <td class="px-4 py-2">{{ $reservation->member->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->book->title }}</td>
                        <td class="px-4 py-2">{{ $reservation->reservation_date }}</td>
                        <td class="px-4 py-2">{{ $reservation->exp_date ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-white 
                                @if($reservation->status === 'pending') bg-yellow-500 
                                @elseif($reservation->status === 'picked_up') bg-green-600 
                                @else bg-red-600 @endif">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.reservations.show', $reservation) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                View
                            </a>
                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this reservation?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                            No reservations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
