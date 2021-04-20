<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    { 
        //  $role="admin@admin.com";
        //  if($request->user()->email != $role){
        //     return redirect('admin')->with('flash_message_error','You are not Allowed!');
        // }else{
        return $next($request);
        //}
    }
}
