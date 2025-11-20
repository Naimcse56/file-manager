@extends('layouts.admin_app')
@section('title')
    Permission
@endsection

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Management/System Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Permission List</li>
            </ol>
        </nav>
    </div>
</div>
<div class="col-xl-12">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-3">Permission List For : {{$role->name}}</h5>
            <form class="form-action" action="{{ route('user-management.permission-store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ request()->route()->parameter('id') }}" name="role_id" />
                <div class="row">
                    <div class="col-md-12 mb-2 fw-bold">
                        <div id="" class="form-check">
                            <input class="form-check-input checkAll" type="checkbox" value="" id="checkAll">
                            <label class="form-check-label" for="checkAll">
                                Select All
                            </label>
                        </div>
                    </div>
                    @foreach ($permissions as $key => $permission)
                    <div class="col-md-6 mb-3">
                        <div class="accordion" id="accordionPanel">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="{{$key}}">
                                    <button class="accordion-button bg-secondary-subtle fw-bold text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#{{$key}}-collapseOne" aria-expanded="true" aria-controls="{{$key}}-collapseOne">
                                        {{ ucwords(str_replace('-',' ',$key)) }}
                                    </button>
                                </h2>
                                <div id="{{$key}}-collapseOne" class="accordion-collapse collapse" aria-labelledby="{{$key}}">
                                    <div class="accordion-body">
                                        <fieldset class="the-fieldset">
                                            <legend class="the-legend">{{ ucwords(str_replace('-',' ',$key)) }}</legend>
                                                @foreach ($permission->groupBy('sub_module') as $sub_module => $items)
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 mb-2 fw-bold">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkAllSubModuleAction" type="checkbox" value="checkAll{{$sub_module}}" id="checkAll{{$sub_module}}">
                                                                <label class="form-check-label fw-semibold" for="checkAll{{$sub_module}}">
                                                                        {{ucwords(str_replace('-',' ',$sub_module))}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @foreach ($items as $item)
                                                            <div class="form-check col-md-4 px-5">
                                                                <input class="form-check-input selctOption_1 checkAll{{$sub_module}}" type="checkbox" name="permissions[]" value="{{ $item->name }}" {{ in_array($item->id, $existing_permissions) ? 'checked' : '' }}>
                                                                <label class="form-check-label">
                                                                    {{ ucwords(str_replace('-',' ',$item->name)) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <br> <br>
                    <div class="col-md-12"><button type="submit" class="btn btn-primary">Update</button></div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".checkAll").change(function() {
        $(".selctOption_1").prop("checked", $(this).prop("checked"));
    });
    $(document).on('change','.checkAllSubModuleAction', function(){
        $('.'+$(this).val()).prop("checked", $(this).prop("checked"));
    });
</script>
@endsection
