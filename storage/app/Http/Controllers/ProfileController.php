<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile()->firstOrCreate([]);
        return view('user.profile', compact('profile'));
    }

    public function update(UpdateProfileRequest $request ,Profile $profile)
    {
        $campos = $request->validated();

        $profile->fill($campos);

        auth()->user()->profile()->save($profile);

        if(request()->hasFile('avatar'))
        {
            try{
                Storage::delete(auth()->user()->profile->avatar);

                tap(request()->file('avatar')->store('avatars', 'public'), function ($ruta) {
                    auth()->user()->fill([ 'avatar' => $ruta])->save();
                });

            }catch (\Exception $e){}
        }

        return back()->with(['success' => 'Account profile has been updated successfully.']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->back();
    }
}
