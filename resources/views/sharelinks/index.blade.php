@extends('layouts.admin_app')
@section('content')
<div class="container">
    <h1>Share Links</h1>

    <form id="createShareForm" method="POST">
        @csrf
        <div class="form-group">
            <label for="file">Select File</label>
            <select id="file" class="form-control">
                @foreach($files as $file)
                    <option value="{{ $file->id }}">{{ $file->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Password (optional)</label>
            <input type="text" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label>Expires At (optional)</label>
            <input type="datetime-local" name="expires_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Create Share Link</button>
    </form>

    <hr>

    <h3>My Share Links</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Link</th>
                <th>File</th>
                <th>Password</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($links as $link)
                <tr>
                    <td><a href="{{ route('share-links.view', $link->token) }}" target="_blank">{{ route('share-links.view', $link->token) }}</a></td>
                    <td>{{ $link->file->name }}</td>
                    <td>{{ $link->password ? 'Yes' : 'No' }}</td>
                    <td>{{ $link->expires_at ? $link->expires_at : 'Never' }}</td>
                    <td>
                        <form action="{{ route('share-links.delete', $link->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">Revoke</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.getElementById('createShareForm').addEventListener('submit', function(e){
    e.preventDefault();
    const fileId = document.getElementById('file').value;
    this.action = `/file-manager/share-links/create/${fileId}`;
    this.submit();
});
</script>
@endsection
