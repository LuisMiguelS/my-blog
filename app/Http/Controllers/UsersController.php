<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\User;
use App\Profile;

class UsersController extends Controller
{
    /*Cualquier metodo de este controlador será ejecutado UNICAMENTE
      si el usuario logueado es ADMIN (por eso se puso un constructor
      en esta clase y no se asignó en las url (web.php) correspondientes a este
      controlador.*/
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => bcrypt('sannin')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.jpg'
        ]);

        Session::flash('success', 'The user has been added successfully.');

        return redirect()->route('users');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->profile()->delete();
        $user->delete();

        Session::flash('success', 'The user has been deleted successfully.');

        return redirect()->route('users');
    }

    public function admin($id)
    {
        $user = User::find($id);

        $user->admin = 1;
        $user->save();

        Session::flash('success', 'Successfully changed user permissions.');

        return redirect()->back();
    }

    public function notAdmin($id)
    {
        $user = User::find($id);

        $user->admin = 0;
        $user->save();

        Session::flash('success', 'Successfully changed user permissions.');

        return redirect()->back();
    }
}
