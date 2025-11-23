@extends('layouts.admin_app')
@section('title')
    {{$detailFolder->name}}
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Folders</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Folder Detail: {{$detailFolder->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a class="btn btn-sm btn-primary px-5" href="{{ route('folder.index') }}"><i class="bi bi-card-list"></i> Folder List</a>
        <a class="btn btn-sm btn-primary px-5" href="{{ route('file-manager.index') }}"><i class="bi bi-card-list"></i> File List</a>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form action="{{ route('file-manager.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						<div class="col-xl-12 mb-3">
							<label class="form-label" for="folder_id">Parent Folder <span class="text-danger">*<span></label>
							<select class="form-select single-select folder_id" id="folder_id" name="folder_id" required>
								<option value="{{$detailFolder->id}}">{{$detailFolder->name}}</option>
							</select>
						</div>
                        <div class="col-xl-12 mb-3">
                            <label class="form-label" for="file">Choose File <span class="text-danger">*<span></label>
                            <input type="file" class="form-control" id="file" name="file" placeholder="Folder Name" required>
                        </div>

                        <div class="submit text-end mt-4">
                            <button type="Submit" class="btn btn-primary px-5">Upload</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
								<th>File Name</th>
                                <th>Size (KB)</th>
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
                ajax: {
                    url: "{{ route('file-manager.file_index') }}",
                    type: "GET",
                    data: function (d) {
                        d.folder_id = '{{$detailFolder->id}}';   // extra parameter
                        d.file_type = $('#file_type').val();   // another parameter
                    }
                },
                pageLength: 50,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'size', name: 'size'},
                    {data: 'action', name: 'action', className: 'text-end', orderable: false, searchable: false},
                ],
            });
            $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
                
        });
    </script>
@endpush