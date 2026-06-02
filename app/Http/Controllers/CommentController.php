<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create([
            'task_id' => $request->task_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        // biar user cuma bisa hapus komentarnya sendiri
        if ($comment->user_id != auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back();
    }
}