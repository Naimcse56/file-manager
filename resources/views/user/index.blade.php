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
                <li class="breadcrumb-item active" aria-current="page">User Information</li>
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
					<form class="row g-4" method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="col-xl-4">
							<label class="form-label" for="name">Name <span class="text-danger">*<span></label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
						</div>
						<div class="col-xl-4">
							<label class="form-label" for="mobile">Mobile</label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
						</div>
						<div class="col-xl-4">
							<label class="form-label" for="email">Email <span class="text-danger">*<span></label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
						<div class="col-xl-4">
							<label class="form-label">Photo </label>
							<input class="form-control" type="file" id="formFile" name="photo">
						</div>
						<div class="col-xl-4">
							<label class="form-label">Password <span class="text-danger">*<span> </label>
							<input type="password" class="form-control" id="signature" name="password" required>
						</div>
						<div class="col-xl-4">
							<label class="form-label">Role Assign <span class="text-danger">*<span></label>
							<select class="form-select single-select" id="role_id" name="role_id" required>
								<option value="0">-- Select --</option>
								@foreach ($roles as $role)
									<option value="{{$role->id}}">{{$role->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-xl-4">
							<label class="form-label">Access <span class="text-danger">*<span></label>
							<select class="form-select single-select" id="has_permit_for_all_access" name="has_permit_for_all_access" required>
								<option value="0" selected>Self Created Files</option>
								<option value="1">All Files</option>
							</select>
						</div>

						<div class="submit text-end">
							<button type="submit" class="btn btn-primary px-5">Submit</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
								<th>Avatar</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Role</th>
                                <th width="5%" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () { 
            "use strict";
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                pageLength: 50,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'avatar', name: 'name'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'role.name', name: 'role.name'},
                    {data: 'action', name: 'action', className: 'text-end', orderable: false, searchable: false},
                ],
            });
            $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
                
        });
    </script>
@endpush