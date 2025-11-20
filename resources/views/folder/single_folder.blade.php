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