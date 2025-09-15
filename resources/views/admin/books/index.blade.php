@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Books</h1>
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
            @foreach($books as $book)
            <tr>
                <td class="p-2 border">{{ $book->title }}</td>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
