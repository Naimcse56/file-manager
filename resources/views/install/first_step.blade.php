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
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">

                                <li class="list-group-item bg-light"><strong>Server Requirements</strong></li>

                                <li class="list-group-item">PHP 8.2 বা এর উপরে</li>
                                <li class="list-group-item">Composer</li>
                                <li class="list-group-item">Apache / Nginx / PHP Built-in Server</li>
                                <li class="list-group-item">MySQL / PostgreSQL / SQLite (যেকোনো ১টি)</li>
                                <li class="list-group-item">Node.js ও NPM/Yarn (Front-end build এর জন্য)</li>

                                <li class="list-group-item bg-light"><strong>Required PHP Extensions</strong></li>
                                <li class="list-group-item">cURL</li>
                                <li class="list-group-item">Fileinfo</li>
                                <li class="list-group-item">JSON</li>
                                <li class="list-group-item">PDO ও আপনার ডাটাবেসের PDO Driver</li>
                                <li class="list-group-item">XML</li>

                            </ul>

                        </div>
                    </div>
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