<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

class Admin
{
    /*Este middleware debe agregarse en el archivo app\Http\Kernel.php*/
    public function handle($request, Closure $next)
    {
        //Si el usuario logueado no es admin ("admin" es el campo que hice en la tabla usuario)
        if(!Auth::user()->admin)
        {
            Session::flash('info', 'You do not permissions to perfom this action.');

            return redirect()->back();
        }

        return $next($request);
    }
}
