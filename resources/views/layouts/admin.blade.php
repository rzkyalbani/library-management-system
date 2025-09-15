<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Admin</title>
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

    <!-- Content -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
