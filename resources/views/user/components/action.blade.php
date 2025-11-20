<div class="btn-group">
    <a type="button" class="btn btn-sm btn-outline-warning" href="{{ route('user.edit',$row->id) }}"><i class="bi bi-pencil-fill"></i></a>
    <button type="button" class="btn btn-sm btn-outline-danger delete_item" onclick="deleteData('Delete User', '{{ route('user.delete') }}', {{ $row->id }})"><i class="bi bi-trash-fill"></i></button>
</div>