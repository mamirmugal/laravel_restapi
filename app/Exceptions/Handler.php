<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            
            // Handling DB exception
            if($e instanceof \Illuminate\Database\QueryException){
                $contains = \Illuminate\Support\Str::contains($e->getMessage(), 'Integrity constraint violation');
                if($contains){
                    Log::error('Integrity constraint violation, Exception message '.$e->getMessage());
                    throw new HttpResponseException(response()->json(['error'=>'Integrity constraint violation, check your property and property_analytics ids'], 403));
                }
            }

        });
    }
}
