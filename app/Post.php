<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {

        $this->comments()->create(compact('body')); // setuje za nas i post_id zbog relacije
    }

    public function liked()
    {
        return $this->belongsToMany(Profile::class);
    }

    public static function mostLiked(){
        return static::selectRaw('count(post_profile.profile_id) as numOfLikes, posts.caption,posts.image, profiles.title')
            ->join('post_profile', 'posts.id', '=', 'post_profile.post_id')
            ->join('profiles', 'posts.user_id', '=', 'profiles.id')
            ->groupBy('posts.caption','posts.image','profiles.title')
            ->orderByRaw('max(post_profile.profile_id) desc')
            ->first();

    }

    public static function mostCommented(){
        return static::selectRaw('count(comments.id) as numOfComments, posts.caption,posts.image,profiles.title')
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->groupBy('posts.caption','posts.image','profiles.title')
            ->orderByRaw('max(comments.id) asc')
            ->first();

    }
}
