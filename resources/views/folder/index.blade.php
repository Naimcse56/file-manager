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
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control form-control-lg ps-5" type="text" placeholder="Search Folder">
                </div>
                <div class="row mt-3">                    
                    @forelse($folders as $folder)
                        <div class="col-12 col-lg-4">
                            <div class="card shadow-none border radius-15">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fm-icon-box radius-15 bg-light-primary text-primary"><i class="bx bxs-folder"></i>
                                        </div>
                                        <div class="ms-auto font-14 ">
                                            {{$folder->files()->count()}} files
                                        </div>
                                    </div>
                                    <h5 class="mt-3 mb-0 text-primary fw-bold">{{$folder->name}}</h5>
                                    <div class="d-flex align-items-center mt-4">
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editFolderModal{{ $folder->id }}"><i class="bi bi-pencil-fill"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete_item" onclick="deleteData('Delete Folder', '{{ route('folder.delete') }}', {{ $folder->id }})"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Edit Folder Modal --}}
                        <div class="modal fade" id="editFolderModal{{ $folder->id }}" tabindex="-1" aria-labelledby="editFolderLabel{{ $folder->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('folder.update', $folder->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title" id="editFolderLabel{{ $folder->id }}">Edit Folder</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" name="name" class="form-control" value="{{ $folder->name }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                            <button type="Submit" class="btn btn-primary px-5">Create Folder</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
