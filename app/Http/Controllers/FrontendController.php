<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public function index()
    {
        return view('layouts.front.login.create');
    }

    public function author(){
        return view('layouts.front.pages.author');
    }
}
