<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Setting;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin');
	}

	public function index()
	{
		return view('admin.settings.settings', ['setting' => Setting::first()]);
	}

    public function update()
    {
    	$this->validate(request(), [
    		'site_name' => 'required',
    		'contact_number' => 'required',
    		'contact_email' => 'required',
    		'address' => 'required'
    	]);

    	$setting = Setting::first();

    	$setting->site_name = request()->site_name;
    	$setting->contact_number = request()->contact_number;
    	$setting->contact_email = request()->contact_email;
    	$setting->address = request()->address;

    	$setting->save();

    	Session::flash('success', 'Settings updated successfully.');

    	return redirect()->back();
    }
}
