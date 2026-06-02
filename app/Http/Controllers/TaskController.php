<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
       public function index(Request $request)
{
    $query = Task::with(['comments.user', 'sharedUsers'])
    ->where(function ($q) {
        $q->where('user_id', auth()->id())
          ->orWhereHas('sharedUsers', function ($sub) {
              $sub->where('users.id', auth()->id());
          });
    });

    // 🔍 SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        });
    }

    // 🎯 FILTER STATUS
    if ($request->status === 'done') {
        $query->where('is_done', true);
    } elseif ($request->status === 'undone') {
        $query->where('is_done', false);
    }

    $tasks = $query->latest()->get();

    // 📊 STATISTIK
    $total = Task::where('user_id', auth()->id())->count();
    $done = Task::where('user_id', auth()->id())->where('is_done', true)->count();
    $undone = Task::where('user_id', auth()->id())->where('is_done', false)->count();

    // 📈 PROGRESS
    $percent = $total > 0 ? round(($done / $total) * 100) : 0;
    $users = \App\Models\User::where('id', '!=', auth()->id())->get();

    return view('tasks', compact(
    'tasks',
    'total',
    'done',
    'undone',
    'percent',
    'users'
    ));
}

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|min:3',
        'deskripsi' => 'required|min:5'
    ]);

   $task = Task::create([
    'judul' => $request->judul,
    'deskripsi' => $request->deskripsi,
    'is_done' => false,
    'deadline' => $request->deadline,
    'user_id' => Auth::id()
]);

        if ($request->filled('shared_users')) {
        $task->sharedUsers()->attach($request->shared_users);
    }

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

    public function toggle($id)
{
    $task = Task::find($id);

    $task->is_done = !$task->is_done;
    $task->save();

    return redirect('/tasks')->with('success', 'Status task diupdate!');
}


}