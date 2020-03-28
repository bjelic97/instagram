<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function store(User $user)
    {
        session()->get('user')->following()->toggle($user->profile); // attached / detached
        $refreshLoggedUser = User::find(session()->get('user')->id);
        session()->put('user', $refreshLoggedUser);

        $profile_url = url('/admin/profile/' . session()->get('user')->profile->id);
        $profile_img_url = url(session()->get('user')->profile->profileImage());

        $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

        $followed_url = url('/admin/profile/' . $user->profile->id);
        $followed_img_url = url($user->profile->profileImage());
        $followed_img = '<img class="ml-2 rounded-circle" style="max-width:40px" src="' . $followed_img_url . '" alt="">';

        if ($refreshLoggedUser->following->contains($user->profile->id)) { // provera ako ga je zapratio
            Activity::publishActivity(
                $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                    'user'
                )->username . '</strong></a> is following' . $followed_img . '  <a class="pl-1" href="' . $followed_url . '"><strong>' . $user->profile->title . '</strong></a>'
            );
        } else { // provera ako ga je otpratio
            Activity::publishActivity(
                $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . session()->get(
                    'user'
                )->username . '</strong></a> unfollowed' . $followed_img . '  <a class="pl-1" href="' . $followed_url . '"><strong>' . $user->profile->title . '</strong></a>'
            );
        }
        return redirect('/profile/' . $user->id);
    }
}
