<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        $total = $tasks->count();

        $done = $tasks->where('is_done', true)->count();

        $undone = $tasks->where('is_done', false)->count();

        $percent = $total > 0
            ? round(($done / $total) * 100)
            : 0;

        return view('dashboard', compact(
            'total',
            'done',
            'undone',
            'percent'
        ));
    }
}