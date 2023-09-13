<?php

namespace App\Services;

use App\Models\Configuracoes;
use App\Models\PeriodoLetivo;
use App\Validators\PeriodoLetivoValidator;
use Illuminate\Support\Facades\App;
use Prettus\Validator\Contracts\ValidatorInterface;

class PeriodoLetivoService
{
    private $validator;

    public function __construct(PeriodoLetivoValidator $validator) {
        $this->validator        = $validator;
    }

    public function all($request)
    {
        return PeriodoLetivo::all();
    }

    public function getPeriodoLetivoIdPadrao($request)
    {
        $c = Configuracoes::where('nome', Configuracoes::CONFIGURACAO_PERIODO_LETIVO_PADRAO)->first();
        if ($c)
            return $c->valor;
        return "";
    }

    public function keep($request)
    {
        
        $this->validator->with($request->input('nome'))->passesOrFail(ValidatorInterface::RULE_CREATE);

        $periodoLetivo = new PeriodoLetivo();
        $periodoLetivo->nome = $request->input('nome');
        $periodoLetivo->id_sigecad = $request->input('id_sigecad');
        $periodoLetivo->descricao = $request->input('descricao');
        $periodoLetivo->sufixo = $request->input('sufixo');
        $periodoLetivo->inicio_auto_increment = $request->input('inicio_auto_increment');
        $periodoLetivo->ativo = $request->has('ativo') ? $request->input('ativo') : false;
        $periodoLetivo->save();
        return $periodoLetivo;
    }

    public function getListaSigecad($request)
    {
        return App::make('SigecadService')->getPeriodoLetivoList($request);
    }

}
