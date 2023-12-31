<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoteSalasSimplificado extends Model
{

    protected $table = 'lote_salas_simplificados';
    
    protected $fillable = [
        'grupo_id',
        'descricao',
        'sala_provao_id',
        'servidor_moodle_id',
        'super_macro_id',
        'sufixo'
    ];

    protected $visible = [
        'id',
        'grupo_id',
        'descricao',
        'sala_provao_id',
        'servidor_moodle_id',
        'super_macro_id',
        'sufixo'
    ];

    public function servidorMoodle()
    {
        return $this->belongsTo('App\Models\ServidorMoodle');
    }

    public function superMacro()
    {
        return $this->belongsTo('App\Models\SuperMacro');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\GrupoLotesSimplificado', 'grupo_id');
    }

    public function salasSimplificadas()
    { 
        return $this->hasMany(SalaSimplificada::class, 'lote_id', 'id');
    }
}
