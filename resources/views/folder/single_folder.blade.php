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
            <div class="d-flex align-items-center">
                <div><h5 class="mt-3 mb-0 text-primary fw-bold">{{$folder->name}}</h5>
                </div>
                <div class="ms-auto font-14 ">
                    {{$folder->children()->count()}} folders
                </div>
            </div>
            
            <div class="d-flex align-items-center mt-4">
                <a href="{{ route('folder.edit', $folder->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-fill"></i></a>
                <button type="button" class="btn btn-sm btn-outline-danger delete_item" onclick="deleteData('Delete Folder', '{{ route('folder.delete') }}', {{ $folder->id }})"><i class="bi bi-trash-fill"></i></button>
            </div>
        </div>
    </div>
</div>