<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Handling/Logging error when authentication fails
            Log::error('Auth failed, url: '.$request->url().' and request payload '.json_encode($request->all()));
            throw new HttpResponseException(response()->json(['error'=>'Unauthorized Request'], 401));
        }
    }
}
