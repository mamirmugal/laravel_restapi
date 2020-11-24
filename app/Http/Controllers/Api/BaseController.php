<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Method to send out 401 error response
     * 
     * @param string error
     * @return \Illuminate\Http\Response
     */
    protected function send401JsonResponse($error){
        return response()->json(['error' => $error], 401);
    }

    /**
     * Method to send out 403 error response
     * 
     * @param string error
     * @return \Illuminate\Http\Response
     */
    protected function send403JsonResponse($error){
        return response()->json(['error' => $error], 403);
    }

    /**
     * Method to send out 404 error response
     * 
     * @param string error
     * @return \Illuminate\Http\Response
     */
    protected function send404JsonResponse($error){
        return response()->json(['error' => $error], 404);
    }
    
    /**
     * Method to send out 200 success response
     * 
     * @param string message
     * @return \Illuminate\Http\Response
     */
    protected function send200JsonResponse($message){
        return response()->json(['success' => $message], 200);
    }
    
    /**
     * Method to send out response
     * 
     * @param array array
     * @return \Illuminate\Http\Response
     */
    protected function sendJsonResponse($array){
        return response()->json($array, 200);
    }
}
