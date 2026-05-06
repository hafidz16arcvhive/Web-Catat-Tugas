<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" bg-white flex items-center justify-center min-h-screen" >

    <div class="bg-[#0a2540] p-6 rounded-2xl shadow w-full max-w-md border-1 border-gray-200 text-white">
        
        <h2 class="text-white text-2xl font-bold text-center mb-6">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4 text-black">
                <label class="block mb-1"></label>
                <input type="email" name="email"
                    class="w-full border p-2 rounded"
                    required placeholder="Masukkan email">
            </div>

            <!-- PASSWORD -->
            <div class="mb-4 text-black">
                <label class="block mb-1"></label>
                <input type="password" name="password"
                    class="w-full border p-2 rounded"
                    required placeholder="Masukkan password">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-[#2ec4b6] hover:bg-[#7226ff] text-white p-2 rounded transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                Login
            </button>

        </form>

        <!-- REGISTER LINK -->
        <p class="text-center mt-4 text-sm">
            Belum punya akun?
            <a href="/register" class="text-[#2ec4b6] hover:underline font-medium">
                Register
            </a>
        </p>

    </div>

</body>
</html>