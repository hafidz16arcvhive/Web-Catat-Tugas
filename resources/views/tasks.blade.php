<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">
        <h2>Ada Tugas Apa Nih?</h2>

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

            <button class="btn btn-success">Simpan Task</button>
        </form>

        <hr>

<h3>Daftar Task</h3>

@foreach ($tasks as $task)
    <div class="card mt-3 p-3">
        <h5>{{ $task->judul }}</h5>
        <p>{{ $task->deskripsi }}</p>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('DELETE')
    <a href="/tasks/{{ $task->id }}/edit" class="btn btn-warning btn-sm">
        Edit
    </a>
            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">
                
                Hapus
            </button>
        </form>
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