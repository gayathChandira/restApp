
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="icon" href="{{asset('img/rest_icon.png')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
</head>
<body class="grey lighten-3">

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">              

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">   
                    <!-- Right -->
                    <ul class="nav navbar-nav nav-flex-icons ml-auto">
                        <li class="nav-item">
                            <a class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Notifications</span></a>
                        </li>                      
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-user"></i>
                                        {{ Auth::user()->fname }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                    </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar -->

        <!-- Sidebar -->
        <div class="sidebar-fixed position-fixed" >

            {{-- <a class="logo-wrapper waves-effect"> --}}
            <img src="{{asset('img/main_logo2.png')}}" class="img-fluid" alt="" style="max-width:64%;margin-left:33px;">
            {{-- </a> --}}

            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item active waves-effect">
                    <i class="fa fa-pie-chart mr-3"></i>Dashboard
                </a>
            <a href="{{url('/register')}}" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-user mr-3"></i>User Registration</a>
                <a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-table mr-3"></i>View Accounts</a>
                <a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-map mr-3"></i>View Reports</a>
                <a href="{{url('/admin/vendors')}}" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-money mr-3"></i>Manage Venders</a>
            </div>
        </div>
        <!-- Sidebar -->

    </header>  

    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            {{-- <div class="card mb-4 wow fadeIn"> --}}                
                @include('inc.messages')
                @yield('content')
            {{-- </div>     --}}
        </div>    
    </main>        
    <!-- SCRIPTS -->
    <!-- JQuery -->
    

    <!-- Tooltips -->
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    <script>
        // // SideNav Button Initialization
        // $(".navbar-toggler").sideNav();
        // // SideNav Scrollbar Initialization
        // var sideNavScrollbar = document.querySelector('.custom-scrollbar');
        // Ps.initialize(sideNavScrollbar);   
    </script>

</body>

</html>
