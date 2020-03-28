<body class="dark-edition">
<div class="wrapper ">


    <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('/img/sidebar-2.jpg')}}">

        <div class="logo"><a href="{{url('/admin/dashboard')}}" class="simple-text logo-normal">
                bjelicgram
            </a></div>

        <div></div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/user')}}">
                        <i class="material-icons">person</i>
                        <p>Users</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
