@extends('layouts.front.master')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.front.partials.sidebar')

            <div style="margin-top:75px" class="col-md-4">

                <div style="border:1px solid #d4d4d4;padding-bottom: 20px;background-color: #fff">

                    <div class="logo" style="text-align: center">
                        <h1 style="margin-top: 30px;">Bjelicgram</h1>
                    </div>

                    <div>
                        <form method="POST" action="{{url('/login')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="email" type="email"
                                           class="form-control" name="email"
                                           value="{{ old('email') }}" autocomplete="email" autofocus
                                           placeholder="E-mail">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-1">
                                    <input id="password" type="password"
                                           class="form-control" name="password"
                                           required autocomplete="current-password" placeholder="Password">

                                </div>
                            </div>

                            @include('layouts.messages.errors')

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-1">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Log In
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>


                </div>

                <div class="mt-3 p-5" style="border:1px solid #d4d4d4;background-color: #fff">
                    <div style="text-align: center">
                        Don't have account ? <a href="{{url('/register')}}"
                                                class="font-weight-bold text-decoration-none" style="color:#003569">Sign
                            Up</a>
                    </div>

                </div>

                <div class="mt-3 p-2" style="border:1px solid #d4d4d4;background-color: #fff">
                    <div style="text-align: center">
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>
                        by Aleksa Bjelicic
                    </div>

                </div>

            </div>


        </div>
    </div>

@endsection
