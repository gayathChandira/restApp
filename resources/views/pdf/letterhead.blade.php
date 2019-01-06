
<html>
<head>
	<title>Letter_head</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


</head>

{{-- <body style="margin:3%"> --}}
<body>

	<img src="{{asset('img/letterhead.png')}}" style="max-width: 100%;margin-bottom: inherit;">

	{{-- <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5"> --}}
            <div class="card mb-5 wow fadeIn">
                <div class="card-body">                   
                    @yield('content')
                </div>
                
            </div>    
        {{-- </div>    
    </main>   --}}

	{{-- <script src="{{ asset('js/app.js') }}"></script>   
   <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>   
   <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>   
   <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/addons/datatables.min.js')}}"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>  --}}
</body>
</html>