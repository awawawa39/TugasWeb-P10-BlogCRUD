<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 1. INDEX (Read + Pagination + Search)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('content', 'like', "%{$search}%");
        })->latest()->paginate(5); // Requirement 8: Pagination

        return view('posts.index', compact('posts', 'search'));
    }

    // 2. CREATE
    public function create()
    {
        return view('posts.create');
    }

    // 3. STORE (Validation + Flash Message + Upload)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Bonus
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
    }

    // 4. SHOW (Route Model Binding)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. EDIT
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6. UPDATE (Validation + Flash Message + Upload)
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    // 7. DESTROY (Soft Delete + Flash Message)
    public function destroy(Post $post)
    {
        $post->delete(); // Karena pakai SoftDeletes, ini tidak akan menghapus permanen
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus (soft delete)!');
    }
}