@extends('layouts.admin_app')
@section('title')
    User Information
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Management/System Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit User Information</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
	<div class="col-xl-12 mx-auto">
		<div class="card">
			<div class="card-body">
				<div class="border p-3 rounded">
					<form class="row g-4" method="POST" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
						@csrf
						<div class="col-xl-4">
							<label class="form-label" for="name">Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}" required>
						</div>
						<div class="col-xl-4">
							<label class="form-label" for="mobile">Mobile</label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{$user->mobile}}">
						</div>
						<div class="col-xl-4">
							<label class="form-label" for="email">Email <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" required>
						</div>
						<div class="col-xl-4">
							<label class="form-label">Photo </label>
							<input class="form-control" type="file" id="formFile" name="photo">
						</div>
						<div class="col-xl-4">
							<label class="form-label">Password </label>
							<input type="password" class="form-control" id="signature" name="password">
						</div>
						<div class="col-xl-4">
							<label class="form-label">Role Assign </label>
							<select class="form-select single-select" id="role_id" name="role_id">
								<option value="0">-- Select --</option>
								@foreach ($roles as $role)
									<option value="{{$role->id}}" @selected($user->role_id == $role->id)>{{$role->name}}</option>
								@endforeach
							</select>
						</div>

						<div class="submit text-end">
							<a href="{{route('user.index')}}" class="btn btn-warning px-5">Back</a>
							<button type="Submit" class="btn btn-primary px-5">Submit</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection