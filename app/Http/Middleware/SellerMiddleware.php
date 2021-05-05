<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (auth()->guest()) {
        //     return redirect()->route('/login');
        // }
      
        //usertype = 2  == seller
        if (Auth::user()->usertype == 2) {
            return $next($request);
        }
        return back();
     
    }
}
