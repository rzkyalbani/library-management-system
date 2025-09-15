<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Member Register</h2>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('member.register') }}">
            @csrf
            <div class="mb-4">
                <label class="block">Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block">Phone</label>
                <input type="text" name="phone" class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block">Address</label>
                <textarea name="address" class="w-full border px-3 py-2 rounded-lg"></textarea>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
                Register
            </button>
        </form>
    </div>

</body>
</html>
