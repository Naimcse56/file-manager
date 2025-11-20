@extends('layouts.auth_app')
@section('content')
<div class="container">
    <h3>This file is password protected</h3>

    <form action="{{ route('share-links.verify', $token) }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
@endsection
