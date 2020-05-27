<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
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
        $user = Auth::user();

        if($user->role)
        {

            $route_name = \Request::route()->getName();

            $r = explode('.' , $route_name);

            $permission_code = $r[0];

            $permission = $user->role->permissions()->where('permission_code', $permission_code)->first();
            // SELECT * FROM permissions WHERE permission_code = $permission_code LIMIT 1;

            if($permission)
            {
                return $next($request);
            }
        }

        $permission = $user->role->permissions()->first();

        return redirect()->route($permission->permission_code.'.index');
    }

}
