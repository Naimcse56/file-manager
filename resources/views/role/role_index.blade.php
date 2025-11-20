@extends('layouts.admin_app')
@section('title')
    Role
@endsection

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Management/System Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Role</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">        
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" method="POST" action="{{route('user-management.role-store')}}">
                        @csrf
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="role_name">Role Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Role Name" id="role_name" name="role_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-3">Role List</h5>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->id > 6)
                                            <button type="button" class="btn btn-sm btn-warning edit" data-id="{{ $role->id }}">Edit</button>
                                        @endif
                                        <a href="{{ route('user-management.permission-index', ['id' => $role->id]) }}" class="btn btn-sm btn-primary">Manage Permission</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="ajaxDiv"></div>
    
@endsection
@push('scripts')
    <script>
        (function($) {
            "use strict";
            $('#example2').DataTable();
            $(document).on('click','.edit', function(){
                let url = APP_URL + "/user-management/role-edit/"+$(this).data("id");

                $.get(url, function(data){
                    $('#ajaxDiv').html(data);
                    $('#editModal').modal('show');
                });
            });
        })(jQuery);
    </script>
@endpush
