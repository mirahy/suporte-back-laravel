<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;


class LoginApiController extends Controller
{

    Private $service;

    public function __construct(UserService $service) {
        $this->service      = $service;
    }
    
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Login"},
     *     summary="User login",
     *     description="Login",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User password",
     *         required=true,
     *     ), 
     *     @OA\Response(
     *      response="200",
     *      description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"token": {"accessToken": {"name": "loginUser_hashNow","abilities": "[*]","expires_at": null,"tokenable_id": 0,"tokenable_type": "App\\Models\\User","updated_at": "2023-09-14T21:20:01.000000Z","created_at": "2023-09-14T21:20:01.000000Z","id": 0},"plainTextToken": "idToken|laravel_sanctum_hash"},"user": {"id": 0,"name": "string","email": "user@example.com","permissao": "USUARIO","created_at": "2023-07-05T19:13:44.000000Z","updated_at": "2023-07-05T19:13:44.000000Z"}}, summary="response"),
     *          ),
     *     ),
     *     
     *     @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     * 
     * @return array
     */

    public function login(Request $request){
       $token = $this->service->auth($request);
       return $token;
    }

    /**
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"Login"},
     *     summary="User logout",
     *     description="Logout",
     *    
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\AdditionalProperties(
     *                 type="integer",
     *                 format="int32"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function logout(Request $request){
        return $this->service->logout($request);
     }

     /**
     * @OA\Get(
     *     path="/api/logado",
     *     tags={"Login"},
     *     summary="Authenticate User",
     *     description="Return Authenticate User",
     *    
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User" )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function usuarioLogado(Request $request) { 
        return $this->service->usuarioLogado($request);
    }

}
