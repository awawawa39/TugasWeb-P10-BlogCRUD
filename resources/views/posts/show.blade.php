@extends('layouts.app')

@section('content')
<x-card title="Detail Post">
    <h3>{{ $post->title }}</h3>
    <p class="text-muted">Dibuat: {{ $post->created_at->format('d M Y H:i') }}</p>
    
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3 rounded" style="max-height: 400px;">
    @endif

    <p>{!! nl2br(e($post->content)) !!}</p>

    <hr>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
</x-card>
@endsection