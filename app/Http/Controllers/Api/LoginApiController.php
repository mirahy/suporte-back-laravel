<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
* @OA\Info(title="Suporte API", version="0.1")
*/

class LoginApiController extends Controller
{

    Private $service;

    public function __construct(UserService $service) {
        $this->service      = $service;
    }
    
    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"LoginApiController"},
     *     summary="User login",
     *     description="Login",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         type="string",
     *         description="User email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         type="string",
     *         description="User password",
     *         required=true,
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="validation_exception"
     *     )
     * )
     */

    public function login(Request $request){
       $token = $this->service->auth($request);
       return $token;
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     tags={"LoginApiController"},
     *     summary="User logout",
     *     description="Logout",
     *    
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="validation_exception"
     *     )
     * )
     */

    public function logout(Request $request){
        return $this->service->logout($request);
     }

     /**
     * @OA\Get(
     *     path="/logado",
     *     tags={"LoginApiController"},
     *     summary="Auth User",
     *     description="User",
     *    
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="validation_exception"
     *     )
     * )
     */

    public function usuarioLogado(Request $request) { 
        return $this->service->usuarioLogado($request);
    }

}
