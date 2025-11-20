@extends('layouts.auth_app')
@section('title')
    Login
@endsection
@section('content')
   <div class="row g-0">
      <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
         <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6">
         <div class="card-body p-4 p-sm-5">
            <form class="form-body" action="{{ route('login') }}" method="POST">
               @csrf
               <div class="login-separater text-center mb-4">
                  <span>OR SIGN IN WITH EMAIL</span>
                  <hr>
               </div>
               <div class="row g-3">
                  <div class="col-12">
                     <label for="email" class="form-label">Email</label>
                     <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                        <input type="email" class="form-control radius-30 ps-5" id="email" @error('email') is-invalid @enderror placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                     
                        @error('email')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-12">
                     <label for="password" class="form-label">Enter Password</label>
                     <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3 @error('password') is-invalid @enderror"><i class="bi bi-lock-fill"></i></div>
                        <input type="password" class="form-control radius-30 ps-5" id="password" placeholder="Enter Password" name="password" required autocomplete="current-password">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                     </div>
                  </div>
                  <div class="col-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
                  </div>
                  <div class="col-12">
                     <div class="d-grid">
                        <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   {{-- <form class="space-y-5" method="POST" action="{{ route('login') }}">
   @csrf
   <div class="row g-3">
      <h2 align="center" class="card-title" style="font-size:18px;">{{env("APP_NAME")}}</h2>

      <div class="col-12" style="text-align:left;">
         <label for="inputEmailAddress" class="form-label">Email Address *</label>
         <div class="ms-auto position-relative">
            <div class="position-absolute top-5 translate-middle-y search-icon px-3">
               <i class="fa-solid fa-user"></i>
            </div>
            <input type="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror" 
               id="inputEmailAddress" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
      </div>

      <div class="col-12" style="text-align:left;">
         <label for="inputChoosePassword" class="form-label">Enter Password *</label>
         <div class="ms-auto position-relative">
            <div class="position-absolute top-5 translate-middle-y search-icon px-3">
               <i class="fa-solid fa-lock"></i>
            </div>

            <!-- Password Input -->
            <input type="password" 
               class="form-control radius-30 ps-5 pe-5 @error('password') is-invalid @enderror" 
               id="inputChoosePassword" name="password" required autocomplete="current-password">

            <!-- Show/Hide Icon -->
            <div class="position-absolute top-50 end-0 translate-middle-y pe-3" style="cursor:pointer;">
               <i class="fa-solid fa-eye" id="togglePassword"></i>
            </div>
         </div>
      </div>

      <div class="col-6 d-none">
         <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
         </div>
      </div>

      <div class="col-12 text-end">
         <a href="{{ route('password.request') }}" style="color:blue;">Forgot Password ?</a>
      </div>

      <div class="col-12">
         <div class="d-grid">
            <button type="submit" class="btn btn-primary radius-30">Sign In</button>
         </div>
      </div>
   </div> --}}
</form>

<script>
   const togglePassword = document.querySelector('#togglePassword');
   const passwordInput = document.querySelector('#inputChoosePassword');

   togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
   });
</script>

@endsection