@extends('layouts.admin_app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Shared Files</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Share Link</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" id="createShareForm" method="POST">
                        @csrf
                        <div class="col-xl-12">
                            <label class="form-label">Select File <span class="text-danger">*<span></label>
                            <select class="form-select single-select" id="file" name="file" required>
                                <option value="0">-- Select --</option>
                                @foreach($files as $file)
                                    <option value="{{ $file->id }}">{{ $file->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label" for="password">Password <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-xl-12">
                            <label class="form-label" for="expires_at">Expires At (optional)</label>
                            <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
                        </div>

                        <div class="submit text-end">
                            <button type="submit" class="btn btn-primary px-5">Create Share Link</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
								<th>Link</th>
                                <th>File</th>
                                <th>Password</th>
                                <th>Expires At</th>
                                <th width="5%" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($links as $link)
                                <tr>
                                    <td>
                                        <button class="btn btn-primary btn-sm copy-link-btn" 
                                                data-link="{{ route('share-links.view', $link->token) }}">
                                            Copy Link
                                        </button>
                                    </td>
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
            </div>
        </div>
</div>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.copy-link-btn', function(e) {
            e.preventDefault(); // prevent any default action

            var $btn = $(this);
            var link = $btn.data('link'); // get the link from data-link attribute

            // Use the Clipboard API
            navigator.clipboard.writeText(link).then(function() {
                // Success notification
                toastr.success('Link copied to clipboard!');

                // Optional: temporarily change button text
                var originalText = $btn.text();
                $btn.text('Copied!');
                setTimeout(function() {
                    $btn.text(originalText);
                }, 1500);

            }).catch(function(err) {
                toastr.error('Failed to copy link.');
            });
        });

        $(document).on('change', '#file', function(e) {
            e.preventDefault(); // Prevent default form submission

            let fileId = $(this).val();

            if (fileId > 0) {
                $('#createShareForm').attr('action', `/file-manager/share-links/create/${fileId}`);
            } else {
                $('#createShareForm').attr('action', '');
            }
        });

    </script>
@endpush
