@extends('layouts.admin_app')

@section('content')
<div class="container mt-4">
    <h3>Folders</h3>

    {{-- Create Folder Form --}}
    <form action="{{ route('folder.store') }}" method="POST" class="mb-4 d-flex gap-2">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Folder Name" required>
        <button type="submit" class="btn btn-primary">Create Folder</button>
    </form>

    {{-- Folder List --}}
    <div class="row">
    @forelse($folders as $folder)
    <div class="col-12 col-lg-4 mb-3">
        <div class="card shadow-none border radius-15">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="font-30 text-primary"><i class="bx bxs-folder"></i></div>
                    <div class="ms-auto d-flex align-items-center">
                        {{-- Edit Folder Button --}}
                        <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editFolderModal{{ $folder->id }}">Edit</button>
                        
                        {{-- Delete Folder Form --}}
                        <form action="{{ route('folder.delete', $folder->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
                <h6 class="mb-0 text-primary">{{ $folder->name }}</h6>
                <small>Created at: {{ $folder->created_at->format('d-M-Y H:i') }}</small>
            </div>
        </div>
    </div>

    {{-- Edit Folder Modal --}}
    <div class="modal fade" id="editFolderModal{{ $folder->id }}" tabindex="-1" aria-labelledby="editFolderLabel{{ $folder->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('folder.update', $folder->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFolderLabel{{ $folder->id }}">Edit Folder</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control" value="{{ $folder->name }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
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

</div>
@endsection
