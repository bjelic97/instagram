<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Comment;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function like_comment(Profile $profile, Comment $comment)
    {
        $profile->likes()->toggle($comment); // attached / detached

        $profile_url = url('/admin/profile/' . $profile->id);
        $profile_img_url = url($profile->profileImage());
        $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

        $comment_owner = url('/admin/profile/' . $comment->user->profile->id);
        $comment_owner_img_url = url($comment->user->profile->profileImage());
        $comment_owner_img_ = '<img class="ml-2 rounded-circle" style="max-width:40px" src="' . $comment_owner_img_url . '" alt="">';


        $post_owner = url('/admin/profile/' . $comment->post->user->profile->id);
        $comment_post_img_url = url('/storage/' . $comment->post->image);
        $comment_post_img_ = '<a href="' . $post_owner . '"><img class="ml-2" style="max-width:40px" src="' . $comment_post_img_url . '" alt=""></a>';

        if ($profile->likes->contains($comment->id)) {
            Activity::publishActivity(
                $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . $profile->title . '</strong></a> liked a ' . $comment_owner_img_ . '  <a class="pl-1" href="' . $comment_owner . '"><strong>' . $comment->user->profile->title . '`s</strong></a> comment
                on post ' . $comment_post_img_
            );
        }


        return redirect()->back();
    }

    public function like_post(Profile $profile, Post $post)
    {
        $profile->likes_post()->toggle($post); // attached / detached

        // agree that this should be separated on other place, but no time..

        $profile_url = url('/admin/profile/' . $profile->id);
        $profile_img_url = url($profile->profileImage());

        $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

        $post_url = url('/admin/profile/' . $post->user->profile->id);
        $post_img_url = url('/storage/' . $post->image);
        $post_img = '<img style="max-width:40px" src="' . $post_img_url . '" alt="">';


        if ($profile->likes_post->contains($post->id)) {
            Activity::publishActivity(
                $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                    'user'
                )->username . '</strong></a> liked a post <a class="pl-3" href="' . $post_url . '">' . $post_img . '</a>'
            );
        }
        return redirect()->back();
    }
}
