<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow">
        <h2>Edit Task</h2>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')

            <input 
                type="text" 
                name="judul" 
                class="form-control mb-3"
                value="{{ $task->judul }}"
            >

            <textarea 
                name="deskripsi" 
                class="form-control mb-3"
            >{{ $task->deskripsi }}</textarea>

            <button class="btn btn-primary">
                Update Task
            </button>

        </form>

    </div>

</div>

</body>
</html>