@extends('layouts.auth_app')
@section('title')
    Password Reset
@endsection
@section('content')
<form class="space-y-5" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="row g-3">
        <h2 align="center" class="card-title" style="font-size:18px;">{{DSCSC ERP}}</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-12" style="text-align:left;">
            <label for="inputEmailAddress" class="form-label">{{ __('Email Address') }}</label>
            <div class="ms-auto position-relative">
            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="fa-solid fa-user"></i>
            </div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                <a href="{{ url('/') }}" class="btn btn-info radius-30 mt-2">Back to Login</a>
            </div>
        </div>
    </div>
</form>
@endsection
