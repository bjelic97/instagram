@extends('layouts.front.master')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.front.partials.sidebar')

            <div style="margin-top:75px" class="col-md-4">

                <div style="border:1px solid #d4d4d4;padding-bottom: 20px">

                    <div class="logo" style="text-align: center">
                        <h1 style="margin-top: 30px;">Bjelicgram</h1>
                    </div>

                    <div style="text-align: center" class="p-3">
                        <h5 style="color:#b3b3b3" class="font-weight-bold">Sign up to see photos from your friends.</h5>
                    </div>

                    <div>
                        <form method="POST" action="{{url('/register')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" autocomplete="username" placeholder="Username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-1">

                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-1">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="mt-3 p-2" style="border:1px solid #d4d4d4;">
                    <div style="text-align: center">
                        Have account ? <a href="{{url('/login')}}" class="font-weight-bold text-decoration-none"
                                          style="color:#003569">Log In</a>
                    </div>

                </div>

            </div>


        </div>
    </div>

@endsection
