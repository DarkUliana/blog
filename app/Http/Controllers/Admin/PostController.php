<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {

        $this->authorize('index', Post::class);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {

            $post = Post::where('image', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('text', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {

            $post = Post::latest()->paginate($perPage);
        }

        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', Post::class);

        $user = $request->user();
        return view('admin.post.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $this->validate($request, [
            'image' => 'required|file|mimes:jpeg,jpg,bmp,png',
            'title' => 'required|string|max:255',
            'short' => 'required|string|max:65535',
            'text' => 'required|string|max:65535',
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $requestData = $request->all();
        if ($request->hasFile('image')) {

            $requestData['image'] = '/storage/' . $request->file('image')
                    ->store('images', 'public');
        }

        Post::create($requestData);

        return redirect('admin/post')->with('flash_message', 'Post added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('create', Post::class);

        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', [Post::class, $post]);

        $user = $request->user();

        return view('admin.post.edit', compact('post', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', [Post::class, $post]);

        $this->validate($request, [
            'image' => 'file|mimes:jpeg,jpg,bmp,png',
            'title' => 'required|string|max:255',
            'short' => 'required|string|max:65535',
            'text' => 'required|string|max:65535',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('image')) {

            $requestData['image'] = $request->file('image')->store('images', 'public');
            Storage::delete($post->image);
        }

        $post->update($requestData);

        return redirect('admin/post')->with('flash_message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', [Post::class, $post]);

        Post::destroy($id);

        return redirect('admin/post')->with('flash_message', 'Post deleted!');
    }
}
