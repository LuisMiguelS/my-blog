<?php

namespace App\Http\Controllers;

use App\Setting;

class SettingController extends Controller
{
	public function index()
	{
        $settings = Setting::first();
		return view('admin.settings.settings', compact('settings'));
	}

    public function update()
    {
    	$campos = request()->validate([
    		'site_name' => 'required',
    		'contact_number' => 'required',
    		'contact_email' => 'required',
    		'address' => 'required'
    	]);

    	$setting = Setting::first();

    	$setting->fill($campos)->save();

    	return back()->with(['success' => 'Settings updated successfully.']);
    }
}
