@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Book</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block">Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Author</label>
            <input type="text" name="author" value="{{ old('author', $book->author) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Publisher</label>
            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Publication Year</label>
            <input type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Category</label>
            <input type="text" name="category" value="{{ old('category', $book->category) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Total Copies</label>
            <input type="number" name="total_copies" value="{{ old('total_copies', $book->total_copies) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Available Copies</label>
            <input type="number" name="available_copies" value="{{ old('available_copies', $book->available_copies) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_digital" value="1" class="mr-2"
                       {{ old('is_digital', $book->is_digital) ? 'checked' : '' }}>
                Is Digital?
            </label>
        </div>

        <div class="mb-3">
            <label class="block">Digital URL</label>
            <input type="url" name="digital_url" value="{{ old('digital_url', $book->digital_url) }}" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.books.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
