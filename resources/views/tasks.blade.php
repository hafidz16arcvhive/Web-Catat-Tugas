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

        <form action="/tasks" method="POST">
            @csrf

            <input type="text" name="judul" class="form-control mb-3" placeholder="Masukkan Mata Kuliah">

            <textarea name="deskripsi" class="form-control mb-3" placeholder="Deskripsi Tugas"></textarea>

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

</body>
</html>