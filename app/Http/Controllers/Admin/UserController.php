<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Authorization\AuthorizationClass;
use App\Http\Controllers\Controller;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\UnauthorizedException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('update', User::class);

        $keyword = $request->get('search');
        $perPage = 25;

        $roles = config('roles.roles');

        if (!empty($keyword)) {
            $user = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate($perPage);
        } else {
            $user = User::latest()->paginate($perPage);
        }

        return view('admin.user.index', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);

        $this->validate($request, [
            'role' => [
                'required',
                Rule::in(array_keys(config('roles.roles')))]
        ]);
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect('admin/user')->with('flash_message', 'User updated!');
    }
}
