<!doctype html>
<html lang="en" class="minimal-theme">

<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
  <title> @yield('title', 'Login') | {{ config('app.name') }}</title>
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
</head>
<body>
    
<div class="wrapper">
  <main class="authentication-content">
    <div class="container-fluid">
      <div class="authentication-card">
        <div class="card shadow rounded-0 overflow-hidden">
          @yield('content')
        </div>
      </div>
    </div>
  </main>
</div>
</body>
<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/pace.min.js')}}"></script>
</body>
</html>