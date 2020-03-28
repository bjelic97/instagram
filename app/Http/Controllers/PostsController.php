<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Comment;
use App\Http\Requests\StorePost;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }


    public function index()
    {
        $signedUser = User::find(\request()->session()->get('user')->id);
        $users = $signedUser->following()->pluck('profiles.user_id');

        if ($users->count() == 0) {
            $users = User::whereNotIn('id', [$signedUser->id, 1])->pluck('id');
        }


        foreach ($users as $userId) {
            $data[] = $userId;
        }
        // fat controller, i know...
        $suggestions = User::whereNotIn('id', [$signedUser->id, 1, $data])->get();
        $count = ($suggestions->count() > 6) ? 5 : $suggestions->count() - 1;
        $suggestions = $suggestions->random($count);
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(4);
        ($posts->count() > 0) ? $posts = $posts : $posts = Post::whereNotIn('user_id', [1])->paginate(4);
        return view('posts.index', compact('posts', 'suggestions'));
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $imagePath = \request('image')->store('uploads', 'public');

        $image = Image::make(public_path('storage/' . $imagePath . ''))->fit(1200, 1200);
        $image->save();

        $post = session()->get('user')->posts()->create(
            [
                'caption' => \request('caption'),
                'image' => $imagePath
            ]
        );
        // fat controller, i know, no time left...

        if (session()->get('user')->role_id != 1) {
            $profile_url = url('/admin/profile/' . session()->get('user')->profile->id);
            $profile_img_url = url(session()->get('user')->profile->profileImage());

            $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

            $post_url = url('/admin/profile/' . $post->user->profile->id);
            $post_img_url = url('/storage/' . $post->image);
            $post_img = '<img style="max-width:40px" src="' . $post_img_url . '" alt="">';

            Activity::publishActivity(
                $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                    'user'
                )->username . '</strong></a> published a new post <a class="pl-3" href="' . $post_url . '">' . $post_img . '</a>'
            );
        }

        return redirect('/profile/' . session()->get('user')->id)->with('message', 'Post successfully created.');
    }


    public function destroy(Post $post)
    {
        try {
            $post->delete();

            if (session()->get('user')->role_id != 1) {
                $profile_url = url('/profile/' . session()->get('user')->profile->id);
                $profile_img_url = url(session()->get('user')->profile->profileImage());

                $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';


                $post_img_url = url('/storage/' . $post->image);
                $post_img = '<img style="max-width:40px" src="' . $post_img_url . '" alt="">';

                Activity::publishActivity(
                    $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                        'user'
                    )->username . '</strong></a> deleted a post <a class="pl-3" href="' . $profile_url . '">' . $post_img . '</a>'
                );
            }


            return redirect('/profile/' . $post->user->profile->id)->with('message', 'Post successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errors', 'An error has ocurred while deleting post.');
        }
    }
}
