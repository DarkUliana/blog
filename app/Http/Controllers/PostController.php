<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $perPage = 6;
        $posts = Post::latest()->paginate($perPage);

        return view('main', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post', compact('post'));
    }
}
