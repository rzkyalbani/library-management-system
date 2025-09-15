<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Member Login</h2>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('member.login') }}">
            @csrf
            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>
</html>
