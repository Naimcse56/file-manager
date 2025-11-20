<div class="btn-group">
    <a class="btn btn-sm btn-outline-info" href="{{ route('file-manager.download',$row->id) }}">Download</a>
    <button type="button" class="btn btn-sm btn-outline-danger delete_item" onclick="deleteData('Delete File', '{{ route('file-manager.delete') }}', {{ $row->id }})"><i class="bi bi-trash-fill"></i></button>
</div>