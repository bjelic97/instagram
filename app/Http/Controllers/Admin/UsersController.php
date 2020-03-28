<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('layouts.admin.pages.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect(url('/admin/user'))->with('message', 'User successfully removed.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errors', 'An error has ocurred while deleting user.');
        }
    }
}
