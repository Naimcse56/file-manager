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
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Folder Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($folders as $folder)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $folder->name }}</td>
                <td>{{ $folder->created_at->format('d-M-Y H:i') }}</td>
                <td>
                    {{-- Edit Folder Modal Trigger --}}
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFolderModal{{ $folder->id }}">Edit</button>

                    {{-- Delete Folder Form --}}
                    <form action="{{ route('folder.delete', $folder->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>

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
            <tr>
                <td colspan="4" class="text-center">No folders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
