<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.users.profile', ['user' => Auth::user()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'facebook' => 'required|url',
            'youtube' => 'required|url'
        ]);

        //Obtengo los datos del usuario logueado
        $user = Auth::user();

        //Si el usuario sube una imagen
        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('uploads/avatars/', $avatar_new_name);
            $user->profile->avatar = 'uploads/avatars/'.$avatar_new_name;
            $user->profile->save();
        }

        #-------------------------------------------#
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->youtube = $request->youtube;
        $user->profile->facebook = $request->facebook;
        $user->profile->about = $request->about;

        $user->save();
        $user->profile->save();
        #-------------------------------------------#

        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        Session::flash('success', 'Account profile has been updated successfully.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
