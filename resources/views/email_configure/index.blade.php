@extends('layouts.admin_app')
@section('title')
    Email Configure
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configure</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Email Configure</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form action="{{ route('email_configure_update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						<div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_MAILER">Mailer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="MAIL_MAILER" name="MAIL_MAILER" value="{{ $mailConfig['MAIL_MAILER'] }}" placeholder="Mailer" required>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_SCHEME">Scheme</label>
                            <input type="text" class="form-control" id="MAIL_SCHEME" name="MAIL_SCHEME" value="{{ $mailConfig['MAIL_SCHEME'] }}" placeholder="Scheme">
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_HOST">Host <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="MAIL_HOST" name="MAIL_HOST" value="{{ $mailConfig['MAIL_HOST'] }}" placeholder="SMTP Host" required>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_PORT">Port <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="MAIL_PORT" name="MAIL_PORT" value="{{ $mailConfig['MAIL_PORT'] }}" placeholder="Port" required>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_USERNAME">Username</label>
                            <input type="text" class="form-control" id="MAIL_USERNAME" name="MAIL_USERNAME" value="{{ $mailConfig['MAIL_USERNAME'] }}" placeholder="Username">
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_PASSWORD">Password</label>
                            <input type="text" class="form-control" id="MAIL_PASSWORD" name="MAIL_PASSWORD" value="{{ $mailConfig['MAIL_PASSWORD'] }}" placeholder="Password">
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="MAIL_FROM_ADDRESS">From Address</label>
                            <input type="email" class="form-control" id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" value="{{ $mailConfig['MAIL_FROM_ADDRESS'] }}" placeholder="From Email">
                        </div>

                        <div class="submit text-end mt-4">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>

                        <div class="submit text-end mt-4">
                            <button type="Submit" class="btn btn-primary px-5">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
