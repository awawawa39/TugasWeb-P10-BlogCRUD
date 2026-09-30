@extends('layouts.app') <!-- Requirement 3 -->

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Post</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah Post</a>
</div>

<form action="{{ route('posts.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari judul atau konten..." value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
    </div>
</form>

<x-card>
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" width="80" class="img-thumbnail">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ Str::limit($post->content, 50) }}</td>
                <td>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <!-- Requirement 7: @method DELETE -->
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada data post.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Requirement 8: Pagination -->
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
</x-card>
@endsection