@extends('layouts.admin_app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Summary</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <h6 class="mb-0 text-uppercase">Total Summary </h6>
        <hr>
        <div class="col-md-3">
            <div class="card radius-10 bg-purple">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-white">Folders</p>
                            <h4 class="mb-0 text-white">59</h4>
                        </div>
                        <div class="ms-auto fs-2 text-white">
                            <i class="bi bi-chat-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h6 class="mb-0 text-uppercase">Total Count Statistic</h6>
        <hr>
        @foreach ($type_wise_count as $item)
            <div class="col-md-3">
                <div class="card radius-10 bg-purple">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1 text-white">{{ $item->category }}</p>
                                <h4 class="mb-0 text-white">{{ $item->total }}</h4>
                            </div>
                            <div class="ms-auto fs-2 text-white">
                                <i class="bi bi-chat-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <h6 class="mb-0 text-uppercase">Size Statistic</h6>
        <hr>
        @foreach ($type_wise_size as $item)
            <div class="col-md-3">
                <div class="card radius-10 bg-purple">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1 text-white">{{ $item->type }}</p>
                                <h4 class="mb-0 text-white">{{ number_format($item->total_mb, 2) }} M</h4>
                            </div>
                            <div class="ms-auto fs-2 text-white">
                                <i class="bi bi-chat-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
