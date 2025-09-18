@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">📱 Digital Books</h1>
            <p class="text-gray-600">Manage e-books and online resources</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:underline">← Back to All Books</a>
    </div>

    <!-- Search & Actions -->
    <div class="flex justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search digital books..."
                class="border px-3 py-2 rounded w-64">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
        </form>
        
        <a href="{{ route('admin.books.create', ['digital' => 1]) }}" 
           class="bg-green-600 text-white px-4 py-2 rounded">
            + Add Digital Book
        </a>
    </div>

    <!-- Digital Books Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Author</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Digital Access</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr class="border-t">
                    <td class="p-3">
                        <a href="{{ route('admin.books.show', $book->id) }}" class="text-blue-600 hover:underline">
                            {{ $book->title }}
                        </a>
                    </td>
                    <td class="p-3">{{ $book->author }}</td>
                    <td class="p-3">{{ $book->category ?: '-' }}</td>
                    <td class="p-3">
                        @if($book->digital_url)
                            <a href="{{ $book->digital_url }}" target="_blank" 
                               class="text-green-600 hover:underline flex items-center gap-1">
                                🔗 Access Link
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        @else
                            <span class="text-red-500">No URL</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" 
                               class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('Delete this digital book?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-8">
                        <div class="text-gray-500">
                            <p class="text-lg mb-2">📱 No digital books found</p>
                            <p class="mb-4">Start building your digital library collection</p>
                            <a href="{{ route('admin.books.create', ['digital' => 1]) }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded inline-block">
                                Add First Digital Book
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($books->hasPages())
    <div class="mt-4">
        {{ $books->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsections