<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            Session::flash('tidaklogin','Anda belum login, Silahkan login terlebih dahulu!');
            return route('login');
            // return back()->with('error', 'Anda belum login, silahkan login terlebih dahulu!');
        }
    }
}
