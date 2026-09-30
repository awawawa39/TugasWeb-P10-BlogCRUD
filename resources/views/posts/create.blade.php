@extends('layouts.app')

@section('content')
<x-card title="Tambah Post Baru">
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Requirement 7 -->
        
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div> <!-- Requirement 5 -->
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</x-card>
@endsection