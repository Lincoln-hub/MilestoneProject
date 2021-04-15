<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

class MySecurityMiddleware
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
        //step 1: you can use the following to get the route YRI $reqyest->path() or
        // we can use $request->is()
        
        $path = $request->path();
        Log::info("Entering mySecurityMiddleware in handle() at path: " .$path);
        
        //step 2: Run all the business rules that check for URI's that you dont need to secure
        $secureCheck = true;
        if($request->is('/') || $request->is('login') || $request->is('portfolio') ||
            $request->is('jobUsers') || $request->is('manageUsers')|| $request->is('profile'))
            $secureCheck = false;
            
            Log::info($secureCheck ? "Security Middleware in handle().... Needs Security":
                "Security Middleware in handle()...... No security required");
            
            //step 3: if entering a secure URI with no security token do a redirect to the login page.
            if(session()->get('security') == 'enabled')
            {
                return $next($request);
            }
            
            if($secureCheck)
            {
                Log::info("Leaving My security Middle ware in handle() doing a redirect to login");
                return redirect('/login');
            }
            return $next($request);
    }
}
