<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    /**
     * @return $this
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', User::class);

        return view('user.index')
            ->with(['users' => User::orderBy('id', 'DESC')->paginate(15)]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('user.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create($request->validated());

        return back()->with(['success'=> "El usuario: {$user->name} ha sido agregado exitosamente."]);
    }

    /**
     * @param \App\User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        abort_if($user->beforeUpdate(), 403);

        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if($user->beforeUpdate() && !auth()->user()->isSuperAdmin(), 403);

        $user->fill($request->validated())->save();

        return back()->with(['success'=> "El usuario: {$user->name} ha sido editado exitosamente."]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        abort_if($user->beforeUpdate() && !auth()->user()->isSuperAdmin(), 403);

        $user->profile()->delete();

        $user->delete();

        return back()->with(['success' => "El usuario: {$user->name} ha sido eliminado con éxito."]);
    }
}
