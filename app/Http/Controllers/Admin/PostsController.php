<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->back()->with('message', 'Post successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errors', 'An error has ocurred while removing post.');
        }
    }
}
