@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::guard('admin')->user()->name }}</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Books Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">📖 Books</h3>
        <p class="text-gray-600 mb-2">Manage all books in the library catalog.</p>
        <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:underline font-medium">Go to Books</a>
    </div>

    <!-- Members Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">👥 Members</h3>
        <p class="text-gray-600 mb-2">View and manage registered library members.</p>
        <a href="{{ route('admin.members.index') }}" class="text-blue-600 hover:underline font-medium">Go to Members</a>
    </div>

    <!-- Borrow/Return Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">📚 Borrow / Return</h3>
        <p class="text-gray-600 mb-2">Track and manage book borrowing transactions.</p>
        <a href="{{ route('admin.borrows.index') }}" class="text-blue-600 hover:underline font-medium">Go to Borrowing</a>
    </div>

    <!-- Reservations Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">📌 Reservations</h3>
        <p class="text-gray-600 mb-2">Track and approve book reservations.</p>
        <a href="#" class="text-blue-600 hover:underline font-medium">Go to Reservations</a>
    </div>

    <!-- Fines Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">💰 Fines</h3>
        <p class="text-gray-600 mb-2">Monitor fines and payments from late returns.</p>
        <a href="{{ route('admin.fines.index') }}" class="text-blue-600 hover:underline font-medium">Go to Fines</a>
    </div>

    <!-- Digital Books Card -->
    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2">📱 Digital Books</h3>
        <p class="text-gray-600 mb-2">Manage access to e-books and online resources.</p>
        <a href="#" class="text-blue-600 hover:underline font-medium">Go to Digital Books</a>
    </div>
</div>
@endsection
