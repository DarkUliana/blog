<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $comments = collect();
        $this->recursiveComments($post->comments->where('parent_id', null), $comments);

        $ratings = Auth::user() ? Auth::user()->ratings() : [];

        return view('post', compact('post', 'comments', 'ratings'));
    }

    private function recursiveComments($comments, &$formattedComments, $level = 0) {


        foreach ($comments as $comment) {

            $comment->level = $level;
            $formattedComments->push($comment);

            if (!$comment->children->isEmpty()) {

                $this->recursiveComments($comment->children, $formattedComments, $level+1);
            }
        }

        return;
    }
}
