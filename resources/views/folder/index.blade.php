@extends('layouts.admin_app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Folders</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Folders List</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" method="POST" action="{{route('folder.store')}}">
                        @csrf
                        <div class="col-xl-12">
                            <label class="form-label" for="name">Folder Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Folder Name" required>
                        </div>

                        <div class="submit text-end">
                            <button type="submit" class="btn btn-primary px-5">Create Folder</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" method="GET" action="{{route('folder.index')}}">
                        <div class="col-md-10">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control form-control  ps-5" id="searchFolder" type="text" name="search" placeholder="Search Folder">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i> Search</button>
                        </div>
                    </form>

                </div>
                
                <div class="row mt-3" id="folderList">                    
                    @forelse($folders as $folder)
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