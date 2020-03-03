<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTAuth;


/**
 * AuthController
 *
 */
class AuthController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:api');
    }

    /**
     * me
     *
     * @access public
     * @return json
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * logout
     *
     * @access public
     * @return json
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * refresh
     *
     * @access public
     * @return json
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * respondWithToken
     *
     * @param string $token
     * @access protected
     * @return json
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
