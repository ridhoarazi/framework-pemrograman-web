<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Tampilkan daftar post (GET /posts)
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Simpan post baru (POST /posts) — butuh login + validasi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $request->user()->posts()->create($validated);

        return redirect('/posts');
    }

    /**
     * Hapus post (DELETE /posts/{post}) — hanya pemilik
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();

        return redirect('/posts');
    }
}
