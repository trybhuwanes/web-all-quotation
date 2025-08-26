<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class VerifyCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!NoCaptcha::verifyResponse($request->input('g-recaptcha-response'))) {
            return redirect()->back()->with('error', 'CAPTCHA verification failed. Please try again.');
        }
        return $next($request);
    }
}
