@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Preview: {{ $file->name }}</h3>

    <div style="width:100%; height:80vh; border:1px solid #ccc;">
        @php
            $ext = strtolower(pathinfo($file->name, PATHINFO_EXTENSION));
        @endphp

        @if(in_array($ext, ['jpg','jpeg','png','gif','bmp','webp']))
            <img src="{{ route('file.preview', $file->id) }}" style="max-width:100%; max-height:100%;" alt="{{ $file->name }}">
        
        @elseif(in_array($ext, ['pdf']))
            <iframe src="{{ route('file.preview', $file->id) }}" style="width:100%; height:100%;" frameborder="0"></iframe>
        
        @elseif(in_array($ext, ['mp4','webm','ogg']))
            <video src="{{ route('file.preview', $file->id) }}" controls style="width:100%; height:100%;"></video>
        
        @elseif(in_array($ext, ['mp3','wav','ogg']))
            <audio src="{{ route('file.preview', $file->id) }}" controls></audio>
        
        @else
            <iframe src="{{ route('file.preview', $file->id) }}" style="width:100%; height:100%;" frameborder="0"></iframe>
        @endif
    </div>
</div>
@endsection
