<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuracoes;
use App\Models\PeriodoLetivo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Services\PeriodoLetivoService;

class PeriodosLetivosController extends Controller
{

    private $service;

    public function __construct(PeriodoLetivoService $service)
    {
        $this->service          =$service;
        $this->middleware('auth');
        $this->middleware('permissao:' . User::PERMISSAO_ADMINISTRADOR . ',' . User::PERMISSAO_USUARIO);
        $this->middleware('permissao:' . User::PERMISSAO_ADMINISTRADOR)->except(['all']);
    }

    public function all(Request $request)
    {
        return $this->service->all($request);
    }

    public function getPeriodoLetivoIdPadrao(Request $request)
    {
       return $this->service->getPeriodoLetivoIdPadrao($request);
    }

    public function store(Request $request)
    {
        return $this->service->keep($request);
    }

    public function getListaSigecad(Request $request)
    {
        return $this->service->getListaSigecad($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periodoLetivo = PeriodoLetivo::find($id);
        if (!$periodoLetivo)
            abort(404, 'Periodo Letivo não encontrado');
        if (!$request->input('nome'))
            abort(400, "um nome é Requerido");
        $periodoLetivo->nome = $request->input('nome');
        $periodoLetivo->id_sigecad = $request->input('id_sigecad');
        $periodoLetivo->inicio_auto_increment = $request->input('inicio_auto_increment');
        $periodoLetivo->descricao = $request->input('descricao');
        $periodoLetivo->sufixo = $request->input('sufixo');
        $periodoLetivo->ativo = $request->has('ativo') ? $request->input('ativo') : false;
        $periodoLetivo->save();
        return $periodoLetivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodoLetivo = PeriodoLetivo::find($id);
        if (!$periodoLetivo)
            abort(404, 'Periodo Letivo não encontrado');
        try {
            $periodoLetivo->delete();
            return new PeriodoLetivo();
        } catch (Exception $e) {
            abort(404, $e->getMessage());
        }
    }
}
