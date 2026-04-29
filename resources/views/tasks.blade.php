<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-brown">

<div class="container mt-5">

    <div class="card p-4 shadow">
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
            
            <button class="btn btn-success">Simpan Task</button>
        </form>

        <hr>

        <h3>Daftar Task</h3>

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