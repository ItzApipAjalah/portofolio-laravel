<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('visitor_recorded') && !$request->has('visitor_recorded')) {
            return $next($request);
        }

        return redirect('/'); // Redirect to homepage or any other page if the visitor is already recorded
    }
}
