<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!Auth::check()) {
            // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');
        }
        
        $user = Auth::user();
        
        foreach ($roles as $role) {
            // dd($user);
            // Check if user has the role This check will depend on how your roles are set up
            if ($user->role == $role)
                return $next($request);
        }

        return response('Anda tidak diperbolehkan mengakses fitur ini. Silakan kembali ke halaman sebelumnya.', 403);
    }
}
