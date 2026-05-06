<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mt-5">

        <h1 class="text-3xl font-bold mb-4">
             👤{{ auth()->user()->name }}
        </h1>

    <div class="card p-4 shadow">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

            <!-- TOTAL -->
            <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">
                <p class="text-gray-500 text-sm">Total Task</p>
                <h2 class="text-3xl font-bold mt-2">{{ $total }}</h2>
            </div>

            <!-- SELESAI -->
            <div class="bg-green-100 p-5 rounded-2xl shadow hover:shadow-lg transition">
                <p class="text-green-700 text-sm">Selesai</p>
                <h2 class="text-3xl font-bold mt-2">{{ $done }}</h2>
            </div>

            <!-- BELUM -->
            <div class="bg-yellow-100 p-5 rounded-2xl shadow hover:shadow-lg transition">
                <p class="text-yellow-700 text-sm">Belum</p>
                <h2 class="text-3xl font-bold mt-2">{{ $undone }}</h2>
            </div>

            <!-- PROGRESS -->
            <div class="bg-blue-100 p-5 rounded-2xl shadow hover:shadow-lg transition">
                <p class="text-blue-700 text-sm">Progress</p>
                <h2 class="text-3xl font-bold mt-2">{{ $percent }}%</h2>
            </div>

        </div>

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

            <br>

        <h2 class="mb-3 fw-bold">📝 Ada Tugas Apa Nih?</h2>
             @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Ada kesalahan:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div>
        @endif
        
        <form action="/tasks" method="POST">
            @csrf

            <input 
            type="text" 
            name="judul" 
            class="form-control mb-3"
            placeholder="Masukkan Mata Kuliah"
            value="{{ old('judul') }}"
            >

            <textarea 
            name="deskripsi" 
            class="form-control mb-3"
            placeholder="Masukkan Deskripsi Tugas"
         >{{ old('deskripsi') }}</textarea>

            <input 
                type="date" 
                name="deadline" 
                class="form-control mb-3"
                value="{{ old('deadline') }}"
            >
            
            <button class="btn btn-success mb-3">Simpan Task</button>
        </form>

        <hr>

        <h3 class="mt-3 mb-3 font-sherif font-medium text-2xl">Daftar Task</h3>

        <form method="GET" action="/tasks" class="mb-4 flex gap-2">

            <!-- SEARCH -->
            <input type="text" name="search" placeholder="Cari task..."
                value="{{ request('search') }}"
                class="border p-2 rounded w-full">

            <!-- FILTER -->
            <select name="status" class="border p-2 rounded">
                <option value="">Semua</option>
                <option value="done" {{ request('status')=='done' ? 'selected' : '' }}>Selesai</option>
                <option value="undone" {{ request('status')=='undone' ? 'selected' : '' }}>Belum</option>
            </select>

            <button class="bg-blue-500 hover:bg-blue-600 text-blue p-2 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>

            @foreach ($tasks as $task)
        <div class="card mb-3 shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-1 {{ $task->is_done ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->judul }}
                    </h5>

                    <span class="badge {{ $task->is_done ? 'bg-success' : 'bg-secondary' }}">
                        {{ $task->is_done ? 'Done' : 'Pending' }}
                    </span>

                </div>

                <p class="text-muted mb-2">{{ $task->deskripsi }}</p>

                <small class="{{ $task->deadline && $task->deadline < now() ? 'text-danger' : 'text-muted' }}">
                    📅 {{ $task->deadline ?? 'Tidak ada deadline' }}
                </small>

                <div class="mt-3 d-flex gap-2">

                    <!-- STATUS -->
                    <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-outline-success">
                            ✔
                        </button>
                    </form>

                    <!-- EDIT -->
                    <a href="/tasks/{{ $task->id }}/edit" class="btn btn-sm btn-outline-warning">
                        ✏️
                    </a>

                    <!-- DELETE -->
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            🗑
                        </button>
                    </form>

                </div>

            </div>
        </div>
    @endforeach
    </div>
</div>
    <div class="alert alert-success" id="alert">
<script>
    setTimeout(() => {
        document.getElementById('alert').style.display = 'none';
    }, 3000);
</script>

</body>
</html>