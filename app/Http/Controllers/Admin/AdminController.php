<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
    }

    public function index()
    {
        $totalPosts = Post::all()->count();
        $totalUsers = User::all()->count();

        $mostFollowedUser = Profile::mostFollowed();
        $mostLikedPost = Post::mostLiked();
        $mostCommentedPost = Post::mostCommented();
        $mostLikedComment = Comment::mostLiked();
        $mostPostsPublished = User::mostPostsPublished();
        $mostPostsLiked = Profile::mostPostsLiked();

        $activities = Activity::whereDate('created_at', Carbon::today())->latest()->paginate(5);

        return view(
            'layouts.admin.pages.dashboard',
            compact(
                'totalPosts',
                'totalUsers',
                'mostFollowedUser',
                'mostLikedPost',
                'mostCommentedPost',
                'mostLikedComment',
                'mostPostsPublished',
                'mostPostsLiked',
                'activities'
            )
        );
    }
}
