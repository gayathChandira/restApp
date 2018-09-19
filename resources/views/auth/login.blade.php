<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="/project/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/project/public/css/mdb.min.css"> --}}
    <title>Nishan Hotel</title>
    <link rel="icon" href="{{asset('img/rest_icon.png')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/css/mdb.min.css" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
   <style>
       /* Required for full background image */
        html,
        body,
        header,
        .view {
        height: 100%;
        }

        @media (max-width: 740px) {
        html,
        body,
        header,
        .view {
            height: 1100px;
        }
        }
        @media (min-width: 800px) and (max-width: 850px) {
        html,
        body,
        header,
        .view {
            height: 700px;
        }
        }

        .top-nav-collapse {
        background-color: #39448c !important;
        }

        .navbar:not(.top-nav-collapse) {
        background: transparent !important;
        }

        @media (max-width: 991px) {
        .navbar:not(.top-nav-collapse) {
            background: #39448c !important;
        }
        }

        h6 {
        line-height: 1.7;
        }
   </style>
  
</head>
<body>
    <!-- Main navigation -->
<header>
        
  <!-- Main navigation -->
        <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/89.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
          <!-- Mask & flexbox options-->
          <div class="mask rgba-indigo-strong d-flex justify-content-center align-items-center">
            <!-- Content -->
            <div class="container">
              <!--Grid row-->
              <div class="row pt-lg-5 mt-lg-5">
                <!--Grid column-->
                <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left wow fadeInLeft" data-wow-delay="0.3s">
                  <h1 class="display-4 font-weight-bold">Nishan Hotel Nivithigala</h1>
                  <hr class="hr-light">
                  <h6 class="mb-3">Nishan Hotel Started as a small restaurant in 2013 with an ambision of providing quality service to its customers. Today we have become a reputed business in Nivithigala area. Our future vision is to continue providing a good service to the customers while ensuring maximum customer satisfaction.</h6>
                  <a class="btn btn-outline-white">Learn more</a>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6 col-xl-5 mb-4">
                  <!--Form-->
                 <!-- Material form login -->
                <div class="card">

                    <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Sign in</strong>
                    </h5>
                
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                
                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <!-- Email -->
                        <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" id="materialLoginFormEmail" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        <label for="materialLoginFormEmail">E-mail</label>
                        @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                        </div>
                
                        <!-- Password -->
                        <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" id="materialLoginFormPassword" class="form-control" name="password" required>
                        <label for="materialLoginFormPassword">Password</label>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        </div>
                
                        <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                            </div>
                        </div>
                        <div>
                            <!-- Forgot password -->
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                        </div>
                
                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>
                                        
                    </form>
          <!-- Form -->
      
        </div>
      
      </div>
      <!-- Material form login -->
                  <!--/.Form-->
                </div>
                <!--Grid column-->
              </div>
              <!--Grid row-->
            </div>
            <!-- Content -->
          </div>
          <!-- Mask & flexbox options-->
        </div> 
        <!-- Full Page Intro -->
      </header>
      <!-- Main navigation -->
    
    {{-- <script src="/project/public/js/jquery-3.3.1.min.js"></script>
    <script src="/project/public/js/popper.min.js"></script>
    <script src="/project/public/js/bootstrap.min.js"></script>
    <script src="/project/public/js/mdb.min.js"></script> --}}
    <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/js/mdb.min.js"></script>
</body>
</html>
