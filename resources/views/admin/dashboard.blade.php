<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">📚 Library Admin</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::guard('admin')->user()->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">📖 Books</h3>
                <p class="text-gray-600">Manage all books in the library catalog.</p>
                <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Go to Books</a>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">👥 Members</h3>
                <p class="text-gray-600">View and manage registered library members.</p>
                <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">Go to Members</a>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-2">📌 Reservations</h3>
                <p class="text-gray-600">Track and approve book reservations.</p>
                <a href="#" class="text-blue-600 hover:underline mt-2 inline-block">Go to Reservations</a>
            </div>
        </div>
    </div>

</body>
</html>
