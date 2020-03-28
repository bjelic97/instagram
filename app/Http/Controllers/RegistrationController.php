<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('layouts.front.register.create');
    }

    public function store(RegisterUser $request)
    {
        $user = $request->persist();

        if ($user) {
            $request->session()->flash('message', 'You have successfully registered.');
            $request->session()->put('user', $user);
            return redirect('/profile/' . $user->profile->id);
        }
    }
}
