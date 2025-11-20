@extends('layouts.admin_app')
@section('content')
<div class="container mt-4">
    <h3>All Files</h3>

    <a href="{{ route('file-manager.upload') }}" class="btn btn-primary mb-3">Upload New File</a>
    <a href="{{ route('file-manager.trash') }}" class="btn btn-warning mb-3">Recycle Bin</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>File Name</th>
                <th>Folder</th>
                <th>Size (KB)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($files as $file)
            <tr>
                <td>{{ $file->name }}</td>
                <td>{{ $file->folder?->name ?? 'Root' }}</td>
                <td>{{ number_format($file->size/1024,2) }}</td>
                <td>
                    <a href="{{ route('file-manager.download',$file->id) }}" class="btn btn-sm btn-success">Download</a>
                    <form action="{{ route('file-manager.delete',$file->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No files found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
