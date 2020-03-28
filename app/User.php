<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot() // Eloquent event
    {
        parent::boot();
        static::created(
            function ($user) {
                $profile = $user->profile()->create(
                    [
                        'title' => $user->username,
                    ]
                );

                if ($user->role_id != 1) {
                    $profile_url = url('/admin/profile/' . $profile->id);

                    $profile_img_url = url($profile->profileImage());

                    $profile_img = '<img class="rounded-circle" style="max-width:40px" src="' . $profile_img_url . '" alt="">';

                    Activity::publishActivity(
                        $profile_img . ' <a class="pl-1" href="' . $profile_url . '"><strong>' . $user->username . '</strong></a> has just registered.
                        <a class="pl-3" href="' . $profile_url . '"></a>');
                }
                //   Mail::to($user->email)->send(new NewUserWelcomeMail());
            }
        );
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    public static function login($email, $password)
    {
        return static::where(
            [
                ['email', '=', $email],
                ['password', '=', md5($password)]
            ]
        )->first();
    }

    public static function mostPostsPublished()
    {
        return static::selectRaw(
            'count(posts.id) as numOfPublishedPosts, profiles.title, profiles.image'
        )
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->groupBy('users.id', 'profiles.title', 'profiles.image')
            ->orderByRaw('max(posts.id) desc')
            ->first();
    }


}
