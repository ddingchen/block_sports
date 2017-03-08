<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class AdminCheck
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
        $adminIds = DB::table('admin_users')->select('id')->get()->pluck('id');
        if ($adminIds->contains(auth()->user()->id)) {
            return $next($request);
        }
        return abort('404', '仅管理员可访问');
    }
}
