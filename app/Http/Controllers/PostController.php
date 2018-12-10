<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $perPage = 5;
        $posts = Post::latest()->paginate($perPage);

        return view('main', compact($posts));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('');
    }
}
