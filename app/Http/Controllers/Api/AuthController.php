<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class AuthController extends BaseController
{
    const TOKEN_NAME = 'ApiUserPassportAuth';

    /**
     * Registering a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $user = User::getByEmail($request->email);
        if (!is_null($user)) {
            return $this->send401JsonResponse('User already exists');
        }

        // Validating a request
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return $this->send401JsonResponse('Request validation fail');
        }

        // Creating a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
  
        // Generating the new access token
        $token = $user->createToken(self::TOKEN_NAME)->accessToken;
        
        // Returning newly generated token
        return $this->sendJsonResponse(['token' => $token]);
    }

    /**
     * Logging in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken(self::TOKEN_NAME)->accessToken;
            return $this->sendJsonResponse(['token' => $token]);
        } else {
            return $this->send401JsonResponse('Unauthorised');
        }
    }
}
