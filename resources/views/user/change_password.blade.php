@extends('layouts.admin_app')
@section('title')
    Change Password
@endsection
@section('content')
<div class="authentication-card">
    <div class="card shadow rounded-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                <img src="{{asset('assets/images/logo.jpg')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title mb-4 text-center">Password Settings</h5>
                    <form class="form-body" method="POST" action="{{route('update_change_password')}}">
						@csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5" id="current_password" name="current_password" placeholder="Enter Current Password">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="new_password" class="form-label">New Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5" id="new_password" name="new_password" placeholder="Enter New Password">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                                <div class="ms-auto position-relative">
                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control radius-30 ps-5" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-primary radius-30">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection