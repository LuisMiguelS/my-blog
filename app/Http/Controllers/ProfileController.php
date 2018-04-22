<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile()->firstOrCreate([]);
        return view('user.profile', compact('profile'));
    }

    public function update(Profile $profile)
    {
        $campos = request()->validate([
            //'avatar' => 'image:jpeg,png,gif,svg|max:5120',
            'about' => 'required|min:20',
            'facebook' => 'required|url',
            'youtube' => 'required|url'
        ]);


        /*if(request()->hasFile('avatar'))
        {
            try{
                Storage::delete(auth()->user()->profile->avatar);
            }catch (\Exception $e){
                //
            }
            $campos['avatar'] = request()->file('avatar')->store('avatars', 'public');
        }*/

        $profile->fill($campos);

        auth()->user()->profile()->save($profile);

        return back()->with(['success' => 'Account profile has been updated successfully.']);
    }
}
