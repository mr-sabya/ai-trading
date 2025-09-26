<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd([
        //     'Is user authenticated?' => Auth::check(),
        //     'User Object' => Auth::user(),
        //     'Is Admin Property' => Auth::user() ? Auth::user()->is_admin : 'User not available',
        // ]);
        // ----> END DEBUGGING CODE <----


        // Original logic
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // If the user is not an admin, redirect them
        return redirect()->route('admin.login')
            ->with('error', 'You do not have admin access.');
    }
}
