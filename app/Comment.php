<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); //eloquent relationships
    }

    public function user()
    {
        return $this->belongsTo(User::class); //eloquent relationships
    }

    public function liked()
    {
        return $this->belongsToMany(Profile::class);
    }

    public static function mostLiked(){
        return static::selectRaw('count(comment_profile.profile_id) as numOfLikes, comments.body, profiles.image, profiles.title')
            ->join('comment_profile', 'comments.id', '=', 'comment_profile.comment_id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->groupBy('comments.body','profiles.image','profiles.title')
            ->orderByRaw('max(comment_profile.profile_id) desc')
            ->first();

    }
}
