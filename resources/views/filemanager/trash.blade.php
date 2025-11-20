@extends('layouts.admin_app')
@section('content')
<div class="container mt-4">
    <h3>Recycle Bin</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>File Name</th>
                <th>Deleted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($files as $file)
            <tr>
                <td>{{ $file->name }}</td>
                <td>{{ $file->deleted_at }}</td>
                <td>
                    <form action="{{ route('file-manager.restore',$file->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success">Restore</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Trash is empty</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
