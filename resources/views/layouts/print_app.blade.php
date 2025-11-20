<!doctype html>
<html lang="en" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/png" />
  <title> @yield('title', 'Print') | {{ config('app.name') }}</title>
    <script>
        const APP_URL = '{{url('/')}}';
        const APP_TOKEN = '{{csrf_token()}}';
    </script>
  <!--plugins-->
  <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />

  <!-- loader-->
  <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="{{asset('assets/css/header-colors.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
  <style>
    
    .table {
        border: #000000 !important;
    }
    th {
        font-size: 12px;
        color: #000000 !important;
    }
    td {
        font-size: 11px;
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
        color: #000000 !important;
    }
    .image-container{
        width: 80%;
        height: 300px;
        position: absolute;
        display: block;
        margin: 2px auto;
        top: 70px;
        left: 80px;
    }
    .img-print-view{
        object-fit: contain;
        z-index: 1;
        display: block;
        width: 100%;
        height: 100%;
        border: 3px solid white;
        opacity: .08;
    }
  </style>
  @stack('styles')
</head>

<body>
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="image-container">
                <img class="img-print-view" src="{{asset('assets/images/logo.jpg')}}" alt="{{env("APP_NAME")}}">               
            </div>
        </div>
    </div>

    @yield('content')
</div>

    <!-- Bootstrap bundle JS -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/form-select2.js')}}"></script>
    <!--app-->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/index2.js')}}"></script>
    @stack('scripts')
    @if (auth()->check())
    <script>
        document.addEventListener('contextmenu', event=> event.preventDefault()); 
            document.onkeydown = function(e) { 
            if(event.keyCode == 123) { 
            return false; 
            } 
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){ 
            return false; 
            } 
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){ 
            return false; 
            } 
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){ 
            return false; 
            } 
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){ 
            return false; 
            } 
        } 
        $( document ).ready(function() {
            window.print();
        });
    </script>
    @endif
</body>

</html>