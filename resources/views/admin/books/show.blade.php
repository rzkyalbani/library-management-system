@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Book Details</h1>

    <div class="mb-3">
        <strong>Title:</strong> {{ $book->title }}
    </div>

    <div class="mb-3">
        <strong>Author:</strong> {{ $book->author }}
    </div>

    <div class="mb-3">
        <strong>Publisher:</strong> {{ $book->publisher }}
    </div>

    <div class="mb-3">
        <strong>ISBN:</strong> {{ $book->isbn }}
    </div>

    <div class="mb-3">
        <strong>Publication Year:</strong> {{ $book->publication_year }}
    </div>

    <div class="mb-3">
        <strong>Category:</strong> {{ $book->category }}
    </div>

    <div class="mb-3">
        <strong>Total Copies:</strong> {{ $book->total_copies }}
    </div>

    <div class="mb-3">
        <strong>Available Copies:</strong> {{ $book->available_copies }}
    </div>

    <div class="mb-3">
        <strong>Is Digital?:</strong> 
        {{ $book->is_digital ? 'Yes' : 'No' }}
    </div>

    @if ($book->is_digital && $book->digital_url)
        <div class="mb-3">
            <strong>Digital URL:</strong> 
            <a href="{{ $book->digital_url }}" target="_blank" class="text-blue-600 underline">
                {{ $book->digital_url }}
            </a>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('admin.books.edit', $book->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded ml-2">Delete</button>
        </form>
        <a href="{{ route('admin.books.index') }}" class="ml-2 text-gray-600">Back to List</a>
    </div>
</div>
@endsection
