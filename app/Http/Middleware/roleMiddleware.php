<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;

class roleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->role==User::ROLE_USER || Auth::user()->role==USER::ROLE_MANAGER) {
            return redirect('user/login');
        }
        return $next($request);
    }

}
