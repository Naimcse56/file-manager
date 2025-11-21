@extends('layouts.admin_app')
@section('title')
    Upload File
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Upload File</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Upload File</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a class="btn btn-sm btn-primary px-5" href="{{ route('file-manager.index') }}"><i class="bi bi-card-list"></i> File List</a>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form action="{{ route('file-manager.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						<div class="col-xl-12 mb-3">
							<label class="form-label" for="folder_id">Parent Folder </label>
							<select class="form-select server-select folder_id" id="folder_id" name="folder_id">
								<option value="0">-- Select Parent Folder --</option>
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
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () { 
            "use strict";
        
            $(".folder_id").select2({
                ajax: {
                    url: '{{route('folder.list_for_select_ajax')}}',
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                            var query = {
                                search: params.term,
                                page: params.page || 1,
                            }
                            return query;
                    },
                    cache: false
                },
                escapeMarkup: function (m) {
                    return m;
                }
            });    
        });
    </script>
@endpush
