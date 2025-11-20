@extends('layouts.auth_app')
@section('content')
<div class="row g-0">
   <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
      <img src="{{asset('assets/images/logo.jpg')}}" class="img-fluid" alt="{{env('APP_NAME')}}">
   </div>
   <div class="col-lg-6">
      <div class="card-body p-4 p-sm-5">
         <form class="form-body" action="{{ route('share-links.verify', $token) }}" method="POST">
            @csrf
            <div class="login-separater text-center mb-4">
               <span>This file is password protected</span>
               <hr>
            </div>
            <div class="row g-3">
               <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <div class="ms-auto position-relative">
                     <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                     <input type="password" class="form-control radius-30 ps-5" id="password" @error('password') is-invalid @enderror placeholder="Password" name="password" value="{{ old('password') }}" required>
                  </div>
               </div>
               <div class="col-12">
                  <div class="d-grid">
                     <button type="submit" class="btn btn-primary radius-30">{{ __('Proceed') }}</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
