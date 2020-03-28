<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// FRONT rute
Route::get('/author', 'FrontendController@author');
Route::get('/home', 'FrontendController@index')->name('home');


Route::get('/login', 'SessionsController@create')->middleware('denyAccess');
Route::post('/login', 'SessionsController@store')->middleware('denyAccess');

Route::post('/logout', 'SessionsController@destroy')->middleware('allowAccess');


Route::get('/register', 'RegistrationController@create')->middleware('denyAccess');
Route::post('/register', 'RegistrationController@store')->middleware('denyAccess');


Route::get(
    '/email',
    function () {
        return new NewUserWelcomeMail();
    }
);


Route::post('follow/{user}', 'FollowsController@store'); // follow
Route::post('like/{profile}/{comment}', 'LikesController@like_comment'); // likes
Route::post('like/{profile}/post/{post}', 'LikesController@like_post'); // likes

Route::get('/profile', 'ProfilesController@autocomplete');

Route::get('/profile/{user}', 'ProfilesController@index'); // midlewares registered through controller DI
Route::get('/profile/{user}/edit', 'ProfilesController@edit'); // midlewares registered through controller DI
Route::patch('/profile/{user}', 'ProfilesController@update'); // midlewares registered through controller DI

Route::get('/p/create', 'PostsController@create'); // midlewares registered through controller DI
Route::post(
    '/p',
    'PostsController@store'
);
Route::delete('/p/{post}', 'PostsController@destroy');

Route::get(
    '/p',
    'PostsController@index'
);

// midlewares registered through controller DI ( => pretier and less robus web.php file )
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p/{post}/comments', 'CommentsController@store');
Route::patch('/p/{post}/comments/{comment}', 'CommentsController@update');
Route::delete('/p/{post}/comments/{comment}', 'CommentsController@destroy');


Route::group(
    ['middleware' => 'admin'],
    function () {
        Route::prefix("/admin")->group(
            function () {
                Route::get('/dashboard', 'Admin\AdminController@index');
                Route::delete("/activity/{activity}", "Admin\ActivitiesController@destroy");
                Route::get('/user', 'Admin\UsersController@index');
                Route::delete("/user/{user}", "Admin\UsersController@destroy");
                Route::get('/profile/{profile}', 'Admin\ProfilesController@show');
                Route::delete("/post/{post}", "Admin\PostsController@destroy");
                Route::delete("/comment/{comment}", "Admin\CommentsController@destroy");
            }
        );
    }
);
