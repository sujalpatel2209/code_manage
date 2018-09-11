<?php

namespace App\Http\Middleware;

use App\AppConstant\AppConstant;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckAdminLogin
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
        $auth = Auth::guard(AppConstant::USER_GUARD);
        if (!$auth->check()) {
            return redirect('login');
        }
        View::share([ 'user' => Auth::guard(AppConstant::USER_GUARD)->user() ]);
        return $next($request);
    }
}
