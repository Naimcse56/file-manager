<!doctype html>
<html lang="en" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/logo.jpg" type="image/png" />
  <title> @yield('title', 'Login') | {{ config('app.name') }}</title>

  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/frontend/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/frontend/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet">
  <!-- loader-->
  <link href="{{asset('assets/frontend/css/pace.min.css')}}" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'custom-blue': '#3b74f7',
            'dark-text': '#333333',
            'light-text': '#666666',
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{asset('assets/images/bg_login.jpg')}}');">
      <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
    </div>

    <div class="relative z-10 p-4 w-full flex justify-center items-center h-full">
      <div class="bg-white rounded-lg p-8 sm:p-10 md:p-12 w-full max-w-sm lg:max-w-md shadow-2xl">
        <div style="margin-top:-70px;" align="center">
          <img src="{{asset('assets/images/logo.png')}}" width="80" alt="" style="border-radius:45px; border-style:solid; border-color:#FFFFFF; border-width:3px;">
        </div>

        @yield('content')

      </div>
    </div>

    <div class="absolute bottom-4 w-full text-center z-10 ">
      <p class=" text-xs text-white opacity-80">
        Design and Developed by:
        <a href="https://simecsystem.com/" target="_blank" class=" hover:text-custom-blue transition duration-150">
          SMEC System Ltd.
        </a>
      </p>
    </div>
</body>
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/pace.min.js')}}"></script>
</body>
</html>