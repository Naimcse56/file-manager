\<!doctype html>
<html lang="en" class="semi-dark color-header headercolor2">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/logo.png')}}" type="image/png" />
  <title> @yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    <script>
        const APP_URL = '{{url('/')}}';
        const APP_TOKEN = '{{csrf_token()}}';
    </script>
  <!--plugins-->
  <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> --}}

  <!-- loader-->
  <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="{{asset('assets/css/dark-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/light-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/semi-dark.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/header-colors.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet" />
  @stack('styles')
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    @include('layouts.partials.admin_header')
    <!--end top header-->

    <!--start sidebar -->
    @if (auth()->user()->password_changed_for_first_time == 1)
        @include('layouts.partials.admin_sidebar')
    @endif
    
    <!--end sidebar -->

    <!--start content-->
    <main class="page-content" id="page_content">
        @yield('content')
    </main>
    <!--end page main-->

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!--plugins-->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('assets/plugins/easyPieChart/jquery.easypiechart.js')}}"></script>
  <script src="{{asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>
  <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>
  <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.j')}}s"></script>
  <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
  <script src="{{asset('assets/js/form-select2.js')}}"></script>
  <!--app-->
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <script src="{{asset('assets/js/sweetalert.js')}}"></script>
  @stack('scripts')
  {!! Toastr::message() !!}
    <script>
    $('.server-select').on('select2:open', function () {
        document.querySelector('.select2-search__field').focus();
    });
      const deleteData = function(title, route, id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to "+title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        _token: APP_TOKEN,
                        id: id,
                    },
                    success: function(response) {
                        if(response.success) {
                          Swal.fire({
                              title: "Success",
                              text: response.message || (title + " Deleted"),  // Use response.message if available
                              icon: "success"
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  location.reload();
                              }
                          });
                      } else if(response.error) {
                          Swal.fire({
                              title: "Error",
                              text: response.error,
                              icon: "error"
                          });
                      }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    };
  </script>
</body>

</html>