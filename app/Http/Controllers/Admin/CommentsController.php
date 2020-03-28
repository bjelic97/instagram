<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back()->with('message', 'Comment successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errors', 'An error has ocurred while removing comment.');
        }
    }
}
