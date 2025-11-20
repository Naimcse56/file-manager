@extends('layouts.admin_app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Folders</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Folders List</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control form-control-lg ps-5" id="searchFolder" type="text" placeholder="Search Folder">
                    <span class="text-danger mt-2" id="minCharacter"></span>
                </div>
                <div class="row mt-3" id="folderList">                    
                    @forelse($folders as $folder)
                        @include('folder.single_folder', ['folder' => $folder])
                    @empty
                        <div class="col-12 text-center">
                            <p>No folders found.</p>
                        </div>
                    @endforelse
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                    <form class="row g-4" method="POST" action="{{route('folder.store')}}">
                        @csrf                        
                        <div class="col-xl-12">
                            <label class="form-label" for="name">Folder Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Folder Name" required>
                        </div>

                        <div class="submit text-end">
                            <button type="Submit" class="btn btn-primary px-5">Create Folder</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function () {
        "use strict";

        let timer = null; // debounce timer

        $('#searchFolder').on('keyup', function () {

            let search = $(this).val();

            clearTimeout(timer);

            // Minimum 3 characters check
            if (search.length < 3) {
                $("#minCharacter").html('Type at least 3 characters to search...');
                return;
            }

            // Debounce: wait 500ms
            timer = setTimeout(function () {

                $.ajax({
                    url: "{{ route('folder.search') }}",
                    type: "GET",
                    data: { search: search },
                    success: function (response) {

                        let folders = response.folders;
                        let html = "";

                        if (folders.length > 0) {

                            $.each(folders, function (index, folder) {
                                html += `
                                    <div class="col-12 col-lg-4">
                                        <div class="card shadow-none border radius-15">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fm-icon-box radius-15 bg-light-primary text-primary">
                                                        <i class="bx bxs-folder"></i>
                                                    </div>
                                                    <div class="ms-auto font-14">0 files</div>
                                                </div>
                                                <h5 class="mt-3 mb-0 text-primary fw-bold">${folder.name}</h5>
                                            </div>
                                        </div>
                                    </div>`;
                            });

                        } else {
                            html = `<div class="col-12 text-center"><p>No folders found.</p></div>`;
                        }

                        $("#folderList").html(html);
                    }
                });

            }, 500);

        });

    });
</script>


@endpush
