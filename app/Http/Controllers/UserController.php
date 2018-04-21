<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::paginate(15)]);
    }

    public function create()
    {
        return view('admin.users.create', ['roles' => Role::get()]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());

        return back()->with(['success'=> "El usuario: {$user->name} ha sido agregado exitosamente."]);
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        $user->fill($request->validated())->save();

        $roles = $request['roles'];

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }


    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->profile()->delete();
        $user->delete();
        return back()->with(['success' => "El usuario: {$user->name} ha sido eliminado con éxito."]);
    }
}
