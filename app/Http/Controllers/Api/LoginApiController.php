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

    public function login(Request $request){
       $token = $this->service->auth($request);
       return $token;
    }

    public function logout(Request $request){
        $token = $this->service->logout($request);
        return $token;
     }

    public function usuarioLogado(Request $request) { 
        return $this->service->usuarioLogado($request);
    }

}
