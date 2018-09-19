
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventory Manager</title>
    <link rel="icon" href="{{asset('img/rest_icon.png')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <style>
        .card{
            padding-left: 73px;
            padding-right: 410px;
            padding-top: 31px;
            padding-bottom: 502px;
        }
        .container-fluid{
            width: 102%;
            margin-left: -23px;
        }
        .btn{
            padding: 0;
            font-size: 15px;
        }
        
    </style>    
</head>
{{-- <body class="fixed-sn light-blue-skin">

    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
                <!-- Logo -->
                <li>
                    <div class="logo-wrapper waves-light">
                        <a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"></a>
                    </div>
                </li>
                <!--/. Logo -->              
               
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="{{url('inventory/update')}}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Update Stock</a>                            
                        </li>
                        <li><a href="{{url('inventory/addnew')}}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Add New Item</a>                            
                        </li>
                        <li><a href="{{url('inventory/recipe')}}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> New Recipe</a>                            
                        </li>
                                            
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Inventory Manager</p>
            </div>
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
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->

    <!--Main Layout-->
    <main>
        <div class="container-fluid mt-5">
            @yield('content');
        </div>
    </main>
    <!--Main Layout-->


     --}}
        
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
        <div class="sidebar-fixed position-fixed">

            <img src="{{asset('img/main_logo2.png')}}" class="img-fluid" alt="" style="max-width:64%;margin-left:33px;">
            

            <div class="list-group list-group-flush">
            <a href="{{url('/inventory')}}" class="list-group-item active waves-effect">
                    <i class="fa fa-pie-chart mr-3"></i>Dashboard
                </a>
                <a href="{{url('inventory/update')}}" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-user mr-3"></i>Update Stock</a>
                <a href="{{url('inventory/addnew')}}" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-table mr-3"></i>Add New Food-Items</a>
                <a href="{{url('inventory/recipe')}}" class="list-group-item list-group-item-action waves-effect">
                    <i class="fa fa-map mr-3"></i>Create Recipes</a>                
            </div>

        </div>
        <!-- Sidebar -->
    </header>  
    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            <div class="card mb-4 wow fadeIn">
                @include('inc.messages')
                @yield('content')
            </div>    
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

        // SideNav Initialization
        $(".button-collapse").sideNav();
        
        new WOW().init();
    
    </script>

</body>

</html>
