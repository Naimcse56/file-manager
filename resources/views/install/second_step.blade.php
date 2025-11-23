@extends('layouts.auth_app')
@section('title')
    Installation
@endsection
@section('content')
<div class="row g-0">
   <div class="col-lg-12">
      <div class="card-body p-4 p-sm-5">
         <div class="login-separater text-center mb-4">
               <span>INSTALL APPLICATION FIRST</span>
               <hr>
            </div>
            <div class="row g-3">
               <div class="col-12">
                   
               </div>
               <div class="col-12">
                  <div class="d-grid">
                     <a href="{{route('install.second_step')}}" class="btn btn-primary radius-30">GO NEXT</a>
                  </div>
               </div>
            </div>
      </div>
   </div>
</div>
@endsection