<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ url('/'.(session()->has('user') ? (session()->get('user')->role_id == 2) ? 'p' : '' : '')) }}">

                <div class="mt-2"><img style="height: 25px; border-right: 1px solid #333333;"
                                       src="{{asset('/svg/instagram.svg')}}" alt="" class="pr-3"></div>
                <div class="logo pl-3 pt-3"><h2>Bjelicgram</h2></div>

            </a>


            <!-- AUTOCOMPLETE  !! -->

            @if(session()->has('user'))
                <div class="autocomplete" style="width:500px;">


                    <input id="filter" type="text" name="filter" class="form-control"
                           placeholder="Search profiles..."/>


                    <div id="autocomplete-list" class="autocomplete-items">

                    </div>
                </div>
        @endif

        <!-- AUTOCOMPLETE  !! -->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if(!session()->has('user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/login')}}">Log In</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/register')}}">Register</a>
                        </li>
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                <img class="rounded-circle mr-2" style="width: 40px"
                                     src="{{session()->get('user')->profile->profileImage()}}"
                                     alt="">

                                {{session()->get('user')->username}}
                                <span class="caret"></span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('/profile/'.session()->get('user')->id)}}">
                                    <i class="fa fa-user"></i> View Profile
                                </a>

                                <a class="dropdown-item" href="{{url('/logout')}}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{url('/logout')}}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
