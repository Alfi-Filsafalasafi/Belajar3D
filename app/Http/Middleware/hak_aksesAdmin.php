<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hak_aksesAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hak_akses == 1){
            return $next($request);
        }
        // return $next($request);
        return redirect('login')->with('Error', "Anda tidak dapat mengakses halaman ini");
    }
}
