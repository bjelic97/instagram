<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg';
        return '/storage/' . $imagePath;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes_post()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopeFilter($query, $filters)
    {
        $title = '%' . $filters['username'] . '%';
        if (!empty($filters)) {
            $query->where('title', 'like', $title);
        }
    }

    public static function mostFollowed()
    {
        return static::selectRaw(
            'count(profile_user.user_id) as numOfFollowers, profiles.title,profiles.image,profiles.description'
        )
            ->join('profile_user', 'profiles.id', '=', 'profile_user.profile_id')
            ->groupBy('profiles.title', 'profiles.image', 'profiles.description')
            ->orderByRaw('max(profile_user.user_id) desc')
            ->first();
    }

    public static function mostPostsLiked()
    {
        return static::selectRaw(
            'count(post_profile.post_id) as numOfLikedPosts, profiles.title, profiles.image'
        )
            ->join('post_profile', 'post_profile.profile_id', '=', 'profiles.id')
            ->join('posts', 'posts.id', '=', 'post_profile.post_id')
            ->groupBy('post_profile.profile_id', 'profiles.title', 'profiles.image')
            ->orderByRaw('max(post_profile.post_id) desc')
            ->first();
    }

}
