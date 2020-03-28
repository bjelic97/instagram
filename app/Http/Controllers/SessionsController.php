<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Http\Requests\LoginUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    public function create()
    {
        return view('layouts.front.login.create');
    }


    public function store(LoginUser $request)
    {
        // Attempt to authenticate user

        $user = User::
        where(
            [
                ['email', '=', $request->input('email')],
                ['password', '=', md5($request->input('password'))],
            ]
        )->first();

        if ($user) {
            $request->session()->put('user', $user);

            if ($user->role_id != 1) {
                $img = '<img class="rounded-circle" style="max-width:40px" src="' . url(
                        $user->profile->profileImage()
                    ) . '" alt="">';

                Activity::publishActivity(
                    $img . ' <a class="pl-1" href="' . url(
                        '/admin/profile/' . $user->profile->id
                    ) . '"><strong>' . $user->username . '</strong></a> has logged in.'
                );
            }

            return redirect(($user->role_id != 1) ? '/p' : '/admin/dashboard');
        } else {
            return redirect()->back()->withErrors('There is no such user with that credentials.');
        }
    }

    public function destroy()
    {
        $user = session()->get('user');

        session()->forget('user');

        if ($user->role_id != 1) {
            $img = '<img class="rounded-circle" style="max-width:40px" src="' . url(
                    $user->profile->profileImage()
                ) . '" alt="">';

            Activity::publishActivity(
                $img . ' <a class="pl-1" href="' . url(
                    '/admin/profile/' . $user->profile->id
                ) . '"><strong>' . $user->username . '</strong></a> has logged out.'
            );
        }
        return redirect()->home();
    }

}
