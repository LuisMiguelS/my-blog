<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    private $methods = [
        'blog' => 'blogConfig',
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
        if (isset($this->methods[$json])) {
            $this->{$this->methods[$json]}();

            return back()->with(['success' => 'Configuraciones actualizadas con éxito']);
        }
        abort(409, 'Conflic');

    }

    private function blogConfig()
    {
        $campos = request()->validate([
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required|email',
            'address' => 'required',
            'blog_facebook' => 'nullable|url',
            'blog_instagram' => 'nullable|url',
            'blog_twitter' => 'nullable|url',
            'blog_youtube' => 'nullable|url',
        ]);

        setting()->set('blog', $this->removeNullvalue($campos));

        setting()->save();
    }

    private function disqusComment()
    {
        $campos = request()->validate([
            'disqus_bloque' => 'required',
            'disqus_script' => 'required',
        ]);

        setting()->set('disqus', $campos);

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

        setting()->set('ads', $campos);

        setting()->save();
    }

    private function shareButton()
    {
        $campos = request()->validate([
            'share_block' => 'required',
            'share_script' => 'required',
        ]);

        setting()->set('shareThis', $campos);

        setting()->save();
    }

    private function removeNullvalue($array)
    {
        return collect($array)->filter(function($value) {
           return $value !== null;
        })->toArray();
    }
}
