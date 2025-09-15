<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">📚 Library Member</h1>
        <form method="POST" action="{{ route('member.logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">
                Logout
            </button>
        </form>
    </nav>

    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::guard('member')->user()->name }}</h2>
        <p class="text-gray-700">Here you can browse books, borrow, and manage your reservations.</p>
    </div>

</body>
</html>
