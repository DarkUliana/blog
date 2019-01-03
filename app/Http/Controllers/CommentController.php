<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'parent_id' => 'sometimes|integer|exists:comments,id',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $parent = $request->parent_id;
        $post = collect();
        $post->id = $request->post_id;
//        dd($post->id);

        return view('create-comment', compact('parent', 'post'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|string|max:255',
            'post_id' => 'required|integer|exists:posts,id',
            'parent_id' => 'sometimes|integer|exists:comments,id',
        ]);

        $data = $request->input();
        $data['user_id'] = Auth::id();

        $parent = Comment::find($request->parent_id);
        $data['level'] = $parent ? $parent->level : 0;

        $comment = Comment::create($data);

        return view('comment', compact('comment'));
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'post_id' => 'required|integer|exists:posts,id'
        ]);

        $comment = Comment::findOrFail($id);

        return view('edit-comment', compact('comment'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|string|max:255',
            'id' => 'integer|exists:comments,id'
        ]);

        Comment::where('id', $request->id)->update($request->input());

        return response('ok', 200);
    }

    public function destroy($id)
    {
        if (Comment::where('parent_id', $id)->count() == 0) {

            Comment::destroy($id);
            return response('ok', 200);
        }

        return response('Can`t delete a comment that has answers', 400);
    }
}
