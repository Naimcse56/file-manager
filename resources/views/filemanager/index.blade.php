@extends('layouts.admin_app')
@section('title')
    All File
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">All Files</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">File List</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a class="btn btn-sm btn-primary px-5" href="{{ route('file-manager.upload') }}"><i class="bi bi-cloud-upload"></i> File Upload</a>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
								<th>File Name</th>
                                <th>Folder</th>
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
                ajax: "{{ route('file-manager.index') }}",
                pageLength: 50,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'folder.name', name: 'folder.name'},
                    {data: 'size', name: 'size'},
                    {data: 'action', name: 'action', className: 'text-end', orderable: false, searchable: false},
                ],
            });
            $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
                
        });
    </script>
@endpush
