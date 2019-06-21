<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    protected $guard = 'admin';

    public function handle($request, Closure $next)
    {
        if (!Auth::guard($this->guard)->check()) {
            return redirect()->route('admin.login');
        }
        $admin = Auth::guard($this->guard)->user();
        if($admin->role == 1){
            echo 'ban la role admin. ';
        }
        elseif($admin->role == 2){
            echo 'ban la role user';
            //return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
