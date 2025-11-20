@extends('layouts.auth_app')
@section('title')
    Password Reset
@endsection
@section('content')
<div class="row g-0">
   <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
      <img src="{{asset('assets/images/logo.jpg')}}" class="img-fluid" alt="{{env('APP_NAME')}}">
   </div>
   <div class="col-lg-6">
      <div class="card-body p-4 p-sm-5">
         <form class="form-body" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="login-separater text-center mb-4">
               <span>PASSWORD RESET</span>
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
                  <div class="d-grid">
                     <button type="submit" class="btn btn-primary radius-30">{{ __('Send Password Reset Link') }}</button>
                  </div>
               </div>
                <div class="col-12">
                    <p class="mb-0">Don't have an account yet? <a href="{{ route('login') }}">Back to Login</a></p>
                </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
