@extends('layouts.auth_app')
@section('title')
    Installation
@endsection
@section('content')
<div class="row g-0">
   <div class="col-lg-12">
        <div class="card-body p-4 p-sm-5">
            <form class="form-body" action="{{ route('install.third_step') }}" method="POST">
                @csrf
                <div class="login-separater text-center mb-4">
                <span>SET DB CREDENTIALS</span>
                <hr>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">DB CONNECTION</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_CONNECTION" @error('DB_CONNECTION') is-invalid @enderror placeholder="DB CONNECTION" name="DB_CONNECTION" value="{{ old('DB_CONNECTION') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">DB HOST</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_HOST" @error('DB_HOST') is-invalid @enderror placeholder="DB HOST" name="DB_HOST" value="{{ old('DB_HOST') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">DB PORT</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_PORT" @error('DB_PORT') is-invalid @enderror placeholder="DB PORT" name="DB_PORT" value="{{ old('DB_PORT') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">DB DATABASE</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_DATABASE" @error('DB_DATABASE') is-invalid @enderror placeholder="DB DATABASE" name="DB_DATABASE" value="{{ old('DB_DATABASE') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">DB USERNAME</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_USERNAME" @error('DB_USERNAME') is-invalid @enderror placeholder="DB USERNAME" name="DB_USERNAME" value="{{ old('DB_USERNAME') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">DB PASSWORD</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"></div>
                            <input type="text" class="form-control radius-30 ps-5" id="DB_PASSWORD" @error('DB_PASSWORD') is-invalid @enderror placeholder="DB PASSWORD" name="DB_PASSWORD" value="{{ old('DB_PASSWORD') }}" required>
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