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
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mt-3" id="folderList">                    
                    @forelse($detailFolder->children as $folder)
                        @include('folder.single_folder', ['folder' => $folder])
                    @empty
                        <div class="col-12 text-center">
                            <p>No folders found.</p>
                        </div>
                    @endforelse
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</div>
@endsection