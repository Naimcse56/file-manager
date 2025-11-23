@extends('layouts.admin_app')
@section('title')
    Edit Folder
@endsection
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Folders</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Folder</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a class="btn btn-sm btn-primary px-5" href="{{ route('folder.index') }}"><i class="bi bi-card-list"></i> Folder List</a>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" method="POST" action="{{route('folder.update', $folder->id)}}">
                        @csrf
						<div class="col-xl-12 mb-3">
							<label class="form-label" for="parent_id">Parent Folder </label>
							<select class="form-select server-select parent_id" id="parent_id" name="parent_id">
								<option value="{{$folder->parent_id}}">{{$folder->parent->name}}</option>
							</select>
						</div>
                        <div class="col-xl-12">
                            <label class="form-label" for="name">Folder Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Folder Name" value="{{$folder->name}}" required>
                        </div>

                        <div class="submit text-end">
                            <button type="submit" class="btn btn-primary px-5">Update Folder</button>
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
        
            $(".parent_id").select2({
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