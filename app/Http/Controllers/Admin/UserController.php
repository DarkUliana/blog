<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Authorization\AuthorizationClass;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $roles = Role::all();

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
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required|exists:roles,id'
        ]);

        $userRole = RoleUser::where('user_id', $id)->first();
        $userRole->role_id = $request->role;
        $userRole->save();

        return redirect('admin/user')->with('flash_message', 'User updated!');
    }
}
