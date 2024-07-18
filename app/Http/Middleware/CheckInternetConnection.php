<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class CheckInternetConnection
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
        try {
            // Cek koneksi dengan melakukan request ke contoh website
            $response = Http::timeout(5)->get('http://www.google.com');
            if ($response->failed()) {
                return redirect()->route('no-internet');
            }
        } catch (\Exception $e) {
            return redirect()->route('no-internet');
        }

        return $next($request);
    }
}
