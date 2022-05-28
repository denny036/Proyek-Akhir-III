<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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

            if($request->routeIs('koordinator.*')){
                return route('koordinator.login');
            }
            if($request->routeIs('petugas.*')){
                return route('petugas.login');
            }
            // if($request->routeIs('mahasiswa.*')){
            //     return route('mahasiswa.login');
            // }

            return route('welcome');
        }
    }
}
