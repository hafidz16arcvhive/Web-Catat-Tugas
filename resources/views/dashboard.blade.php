<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-1">
                    Welcome back, {{ auth()->user()->name }} 👋
                </p>
            </div>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="bg-white px-5 py-2 rounded-xl shadow-sm hover:shadow transition">
                    Logout
                </button>
            </form>

        </div>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <!-- TOTAL -->
            <div class="bg-white p-5 rounded-2xl shadow-sm">
                <p class="text-gray-500 text-sm">Total Task</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $total }}
                </h2>
            </div>

            <!-- DONE -->
            <div class="bg-green-100 p-5 rounded-2xl shadow-sm">
                <p class="text-green-700 text-sm">Selesai</p>
                <h2 class="text-3xl font-bold mt-2 text-green-500">
                    {{ $done }}
                </h2>
            </div>

            <!-- UNDONE -->
            <div class="bg-red-300 p-5 rounded-2xl shadow-sm">
                <p class="text-red-700 text-sm">Belum</p>
                <h2 class="text-3xl font-bold mt-2 text-black">
                    {{ $undone }}
                </h2>
            </div>

            <!-- PROGRESS -->
            <div class="bg-blue-100 p-5 rounded-2xl shadow-sm">
                <p class="text-blue-700 text-sm">Progress</p>
                <h2 class="text-3xl font-bold mt-2 text-black">
                    {{ $percent }}%
                </h2>
            </div>

        </div>

        <!-- PROGRESS BAR -->
        <div class="bg-white p-4 rounded-2xl shadow mb-6">
                <p class="mb-2 font-medium">Progress Task</p>

                <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                    <div class="bg-blue-500 h-4 rounded-full transition-all duration-500"
                        style="width: {{ $percent }}%">
                    </div>
                </div>

                <p class="text-sm mt-2 text-gray-500">{{ $percent }}% selesai</p>
            
                @if($percent == 100)
                    <p class="text-green-600 font-semibold mt-2">🎉 Semua task selesai!</p>
                @endif

            </div>

        <!-- ACTION CARD -->
        <div class="bg-white rounded-2xl shadow-sm p-8">

            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                Ayo Kelola Tugasmu📋
            </h2>

            <p class="text-gray-500 mb-6">
                Selalu Catat semua tugasmu biar ga lupa, dan pastikan kamu menyelesaikannya tepat waktu ✨
            </p>

            <!-- BUTTON -->
            <a href="/tasks"
               class="inline-block bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-xl transition">

                Buka Task

            </a>

        </div>

    </div>

</body>
</html>