<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('user');
        // $this->middleware(['allowAccess','admin']);
    }

    public function autocomplete()
    {
        return Profile::filter(\request(['username']))
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->where('users.role_id', '=', '2')
            ->get()->toArray();
    }

    public function index(User $user)
    {
        $follows = (\request()->session()->has('user')) ? User::find(
            \request()->session()->get('user')->id
        )->following->contains($user->id) : false;

//        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.post.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            }
        );

        //$followingCount = $user->following->count();
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        //$this->authorize('update', $user->profile); //ovde mora is admin middleware definitivno da ne bi mogao da upada i postuje sta hoce ljudima
        if (session()->get('user')->id == $user->profile->user_id) {
            return view('profiles.edit', compact('user'));
        }
        return redirect()->back();
    }

    public function update(UpdateProfile $request, User $user)
    {
        // $this->authorize('update', $user->profile);


        if (\request('image')) {
            $imagePath = \request('image')->store('profile', 'public');
            $image = Image::make(public_path('storage/' . $imagePath . ''))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $request->session()->get('user')->profile->update(
            array_merge(
                \request(['title', 'description', 'url']),
                $imageArray ?? []
            )
        );

        return redirect('profile/' . $user->id)->with('message', 'Profile successfully updated.');
    }
}

