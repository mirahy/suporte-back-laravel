<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* @OA\Info(
*      version="1.0.0",
*      title="Suporte API Documentation",
*      description="Suporte API Documentation descriptions routes and models",
*      @OA\Contact(
*          email="ti.ead@ufgsd.edu.br"
*      ),
* )
*
* @OA\Server(
*      url="",
*      description="Suporte EaD API Server"
* )
*
* 
* @OA\SecurityScheme(
*     type="apiKey",
*     in="header",
*     securityScheme="api_key",
*     name="Authorization"
* )
*/

class SwaggerController extends Controller
{
    public function __construct() {}

    public function index(){
        return view("swagger.index");
    }
}
