<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserVerified {
    public function handle($request, Closure $next)
    {
        if ( Auth::user()->is_verified == 0 ) {
            if ( $request->ajax() || $request->wantsJson() ) {
                return response('Unauthorized.', 401) ;
            } else {
                return redirect()->to('verify_account') ;
            }
        }
        return $next($request);
    }
}
