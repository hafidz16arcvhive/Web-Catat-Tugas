<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-b from-gray-100 to-gray-200 min-h-screen flex items-center justify-center px-4">

    <!-- CARD -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-sm p-8">

        <!-- TITLE -->
        <div class="mb-5 text-center">

            <h1 class="text-4xl font-bold text-gray-800">
                TaskFlow
            </h1>

            <p class="text-gray-500 mt-1">
                Create your account ✨
            </p>

        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-xl mb-5">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- NAME -->
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="Masukkan nama"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

            </div>

            <!-- EMAIL -->
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

            </div>

            <!-- CONFIRM PASSWORD -->
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi password"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-gray-900 hover:bg-black text-white py-3 rounded-xl transition">

                Register

            </button>

        </form>

        <!-- LOGIN -->
        <p class="text-center text-gray-500 mt-5">

            Sudah punya akun?

            <a href="/login"
               class="text-gray-900 font-medium hover:underline">

                Login

            </a>

        </p>

    </div>

</body>
</html>