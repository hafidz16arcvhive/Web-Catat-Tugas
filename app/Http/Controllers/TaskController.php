<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
        public function index()
    {
        $tasks = Task::all();

        return view('tasks', compact('tasks'));
    }

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|min:3',
        'deskripsi' => 'required|min:5'
    ]);

    Task::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi
    ]);

    return redirect('/tasks')->with('success', 'Task berhasil ditambahkan!');
}

        public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

       return redirect('/tasks')->with('success', 'Task berhasil dihapus!');
    }

    public function edit($id)
    {
        $task = Task::find($id);

        return view('edit-task', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('/tasks')->with('success', 'Task berhasil diupdate!');
    }
}