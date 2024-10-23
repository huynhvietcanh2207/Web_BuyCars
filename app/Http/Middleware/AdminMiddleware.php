<?php
// App\Http\Middleware\AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roles->contains('RoleName', 'admin')) {
            return $next($request);
        }

        return redirect('/')->withErrors('Bạn không có quyền truy cập trang này.');
    }
}

