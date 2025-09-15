@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add New Book</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Author</label>
            <input type="text" name="author" value="{{ old('author') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Publisher</label>
            <input type="text" name="publisher" value="{{ old('publisher') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Publication Year</label>
            <input type="number" name="publication_year" value="{{ old('publication_year') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Category</label>
            <input type="text" name="category" value="{{ old('category') }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Total Copies</label>
            <input type="number" name="total_copies" value="{{ old('total_copies', 1) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block">Available Copies</label>
            <input type="number" name="available_copies" value="{{ old('available_copies', 1) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_digital" value="1" class="mr-2" {{ old('is_digital') ? 'checked' : '' }}>
                Is Digital?
            </label>
        </div>

        <div class="mb-3">
            <label class="block">Digital URL</label>
            <input type="url" name="digital_url" value="{{ old('digital_url') }}" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('admin.books.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
