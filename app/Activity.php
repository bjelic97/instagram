<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'body'
    ];


    public static function publishActivity($body)
    {
        return Activity::create(
            [
                'body' => $body
            ]
        );
    }
}
