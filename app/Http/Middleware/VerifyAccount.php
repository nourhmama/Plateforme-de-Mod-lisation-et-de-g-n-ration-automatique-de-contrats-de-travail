<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyAccount
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && !$request->user()->verified) {
            return response()->json(['message' => 'Votre compte n\'a pas été vérifié.'], 403);
        }


        return $next($request);
    }
}
