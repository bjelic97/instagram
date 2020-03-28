<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Comment;
use App\Http\Requests\StoreComment;
use App\Http\Requests\UpdateComment;
use App\Http\Requests\UpdateProfile;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CommentsController extends Controller
{
    public function store(Post $post, StoreComment $request)
    {
        //  $post->addComment(\request('body'));

        try {
            $comment = Comment::create(
                [
                    'post_id' => $post->id,
                    'user_id' => $request->session()->get('user')->id,
                    'body' => $request->input('body'),
                ]
            );

            if (session()->get('user')->role_id != 1) {
                $profile_url = url('/profile/' . session()->get('user')->profile->id);
                $profile_img_url = url(session()->get('user')->profile->profileImage());

                $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

                $post_url = url('/p/' . $post->id);
                $post_img_url = url('/storage/' . $post->image);
                $post_img = '<img style="max-width:40px" src="' . $post_img_url . '" alt="">';

                Activity::publishActivity(
                    $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                        'user'
                    )->username . '</strong></a> commented on post <a class="pl-3" href="' . $post_url . '">' . $post_img . '</a>'
                );
            }


            return redirect()->back()->with('message', 'Comment successfully added.');;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message', 'An error ocurred while adding comment.');;
        }
    }


    public function update(UpdateComment $request, Post $post, Comment $comment)
    {
        $commentForUpdate = $post->comments()->find($comment->id);

        $commentForUpdate->update(
            ['body' => $request->input('body')]
        );

        return redirect()->back()->with('message', 'Comment successfully updated.');
    }


    public function destroy(Post $post, Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back()->with('message', 'Comment successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message', 'An error ocurred while removing comment.');;
        }
    }
}
