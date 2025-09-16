@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">Add Borrow Transaction</h1>

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.borrows.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block font-medium mb-1">Member</label>
        <select name="member_id" class="border rounded w-full p-2">
            <option value="">-- Select Member --</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                    {{ $member->name }} ({{ $member->email }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium mb-1">Book</label>
        <select name="book_id" class="border rounded w-full p-2">
            <option value="">-- Select Book --</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                    {{ $book->title }} (Available: {{ $book->available_copies }})
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Borrow</button>
</form>
@endsection
