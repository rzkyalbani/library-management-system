@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    <!-- Search form -->
    <form method="GET" action="{{ route('admin.books.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search by title or author"
            class="border px-3 py-2 rounded w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Search
        </button>
        <a href="{{ route('admin.books.index') }}" class="bg-gray-300 px-4 py-2 rounded">
            Reset
        </a>
    </form>

    <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Book</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Author</th>
                <th class="p-2 border">Available</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td class="p-2 border">
                    <a href="{{ route('admin.books.show', $book->id) }}" class="text-blue-600 underline">
                        {{ $book->title }}
                    </a>
                </td>
                <td class="p-2 border">{{ $book->author }}</td>
                <td class="p-2 border">{{ $book->available_copies }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-4">No books found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection
