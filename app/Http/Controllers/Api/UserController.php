<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service      = $service;
        $this->middleware('auth');
        $this->middleware('permissao:' . User::PERMISSAO_ADMINISTRADOR)->except(['usuarioLogado', 'list']);
    }

    /**
     * @OA\Get(
     *     path="/api/usuarios/lista",
     *     tags={"UserController"},
     *     summary="Return all users",
     *     description="All",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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

    public function all()
    {
        return $this->service->all();
    }

    /**
     * @OA\Get(
     *     path="/api/salas/usuarios",
     *     tags={"UserController"},
     *     summary="Return all users if user is Admin",
     *     description="List",
     *     @OA\Response(
     *         response="200",
     *         description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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

    public function list(Request $request)
    {
        return $this->service->list($request);
    }

    public function usuarioEmail($uid)
    {
        return $this->service->usuarioEmail($uid);
    }

    public function getInfosLdapServidorByDescription($cpf, $createUser = false)
    {
        return $this->service->getInfosLdapServidorByDescription($cpf, $createUser);;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->service->keep($request);
        return $this->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return $this->service->show($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return $this->service->edit($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        return $this->service->update($request, $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        return $this->service->delete($usuario);
    }

    public function getFirstLastNameUser()
    {
        return $this->service->getFirstLastNameUser();
    }

    public function getAllTokensUser(Request $request)
    {
        return $this->service->getAllTokensUser($request);
    }

    public function revokeAllTokensUser(Request $request)
    {
        // Revoke all tokens...
        return json_encode($this->service->revokeAllTokensUser($request));
    }
}
