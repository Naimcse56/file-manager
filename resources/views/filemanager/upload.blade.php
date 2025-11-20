@extends('layouts.admin_app')
@section('content')
<div class="container mt-4">
    <h3>Upload File</h3>

    <form action="{{ route('file-manager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="folder_id" class="form-label">Select Folder (optional)</label>
            <select name="folder_id" class="form-select">
                <option value="">-- Root --</option>
                @foreach($folders as $folder)
                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Choose File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
