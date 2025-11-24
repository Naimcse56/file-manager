@extends('layouts.auth_app')
@section('title')
    Installation
@endsection
@section('content')
<div class="row g-0">
   <div class="col-lg-12">
        <div class="card-body p-4 p-sm-5">
            <form class="form-body" action="{{ route('install.fifth_step') }}" method="POST">
                @csrf
                <div class="login-separater text-center mb-4">
                <span>SET ADMIN LOGIN CREDENTIALS</span>
                <hr>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">ADMIN NAME</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-chevron-right-circle"></i></div>
                            <input type="text" class="form-control radius-30 ps-5" id="name" @error('name') is-invalid @enderror placeholder="ADMIN NAME" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">EMAIL</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-chevron-right-circle"></i></div>
                            <input type="text" class="form-control radius-30 ps-5" id="email" @error('email') is-invalid @enderror placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">PASSWORD</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-chevron-right-circle"></i></div>
                            <input type="password" class="form-control radius-30 ps-5" id="password" @error('password') is-invalid @enderror placeholder="PASSWORD" name="password" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">CONFIRM PASSWORD</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-chevron-right-circle"></i></div>
                            <input type="password" class="form-control radius-30 ps-5" id="confirm_password" @error('confirm_password') is-invalid @enderror placeholder="CONFIRM PASSWORD" name="confirm_password" value="{{ old('confirm_password') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary radius-30">PROCEED</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
   </div>
</div>
@endsection