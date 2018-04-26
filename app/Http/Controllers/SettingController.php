<?php

namespace App\Http\Controllers;

use App\Setting;

class SettingController extends Controller
{
    private $methods = [
        'blog' => 'blogBasic',
        'disqus' => 'disqusComment',
        'ads' => 'ads',
        'shareThis' => 'shareButton'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
	{
        $this->authorize('only-superadmin');

		return view('admin.settings.settings');
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function comment()
    {
        $this->authorize('only-superadmin');

        return view('admin.settings.comments');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function share()
    {
        $this->authorize('only-superadmin');

        return view('admin.settings.share');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function adsView()
    {
        $this->authorize('only-superadmin');

        return view('admin.settings.ads');
    }


    public function update($json)
    {
        $this->{$this->methods[$json]}();

    	return back()->with(['success' => 'Configuraciones actualizadas con éxito']);
    }

    private function blogBasic()
    {
        $campos = request()->validate([
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
            'address' => 'required',
            'blog_facebook' => 'nullable|url',
            'blog_instagram' => 'nullable|url',
            'blog_twitter' => 'nullable|url',
            'blog_youtube' => 'nullable|url',
        ]);

        setting()->set('blog', [
            'name' => $campos['site_name'],
            'contact_number' => $campos['contact_number'],
            'contact_email' => $campos['contact_email'],
            'address' => $campos['address'],
            'facebook' => $campos['blog_facebook'],
            'instagram' => $campos['blog_instagram'],
            'twitter' => $campos['blog_twitter'],
            'youtube' => $campos['blog_youtube'],
        ]);

        setting()->save();
    }

    private function disqusComment()
    {
        $campos = request()->validate([
            'disqus_bloque' => 'required',
            'disqus_script' => 'required',
        ]);

        setting()->set('disqus', [
            'bloque' => $campos['disqus_bloque'],
            'script' => $campos['disqus_script'],
        ]);

        setting()->save();
    }

    private function ads()
    {
        $campos = request()->validate([
            'ads_top' => 'required',
            'ads_side' => 'required',
            'ads_bottom' => 'required',
            'ads_script' => 'required'
        ]);

        setting()->set('ads', [
            'ads_top' => $campos['ads_top'],
            'ads_side' => $campos['ads_side'],
            'ads_bottom' => $campos['ads_bottom'],
            'ads_script' => $campos['ads_script'],
        ]);

        setting()->save();
    }

    private function shareButton()
    {
        $campos = request()->validate([
            'share_block' => 'required',
            'share_script' => 'required',
        ]);

        setting()->set('shareThis', [
            'bloque' => $campos['share_block'],
            'script' => $campos['share_script'],
        ]);

        setting()->save();
    }
}
