<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Buscador.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="Buscador model",
 *     title="Buscador",
 *     required={"chave", "entrada", "macro_id"},
 *     @OA\Xml(
 *         name="Buscador"
 *     )
 * )
 */


class Buscador extends Model
{
    const BUSCADOR_NOME_SALA = "NOME_SALA";
    const BUSCADOR_NOME_PROFESSOR = "NOME_PROFESSOR";
    const BUSCADOR_SENHA_ALUNO = "SENHA_ALUNO";
    const BUSCADOR_SENHA_PROFESSOR = "SENHA_PROFESSOR";
    const BUSCADOR_EMAIL = "EMAIL";
    const BUSCADOR_FACULDADE = "FACULDADE";
    const BUSCADOR_CURSO = "CURSO";
    const BUSCADOR_PROVAO_ID = "PROVAO_ID";
    const BUSCADOR_TIMESTAMP_CORRENTE = "TIMESTAMP_CORRENTE";

    public static function getEntradasBuscadores() {
        return [
            self::BUSCADOR_NOME_SALA,
            self::BUSCADOR_NOME_PROFESSOR,
            self::BUSCADOR_SENHA_ALUNO,
            self::BUSCADOR_SENHA_PROFESSOR,
            self::BUSCADOR_EMAIL,
            self::BUSCADOR_FACULDADE,
            self::BUSCADOR_CURSO,
            self::BUSCADOR_PROVAO_ID,
            self::BUSCADOR_TIMESTAMP_CORRENTE,
        ];
    }
    
    protected $table = 'buscadores';

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var int
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Chave",
     *     description="Chave",
     *     maxLength=31,
     * )
     *
     * @var String
     */
    private $chave;

     /**
     * @OA\Property(
     *     title="Entrada",
     *     description="Entrada",
     *     maxLength=31,
     * )
     *
     * @var String
     */
    private $entrada;

    /**
     * @OA\Property(
     *     title="Macro_id",
     *     description="Macro_id",
     * )
     *
     * @var int
     */
    private $macro_id;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="int",
     *     default="CURRENT_TIMESTAMP",
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="int",
     *     default="NULL",
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    protected $fillable = [
        'id',
        'chave',
        'entrada',
        'macro_id'
    ];
    protected $visible =  [
        'id',
        'chave',
        'entrada'
    ];

    /*protected $appends = array('macro');
    public function getMacroAttribute($value) {
        return Macro::find($this->macro_id);
    }
    public function setMacroAttribute($value) {
        $this->macro_id = $value->id;
    }*/
    
    /*
    * Muitos para um
    */
    
    public function macro()
    {
        return $this->belongsTo('App\Models\Macro');
    }

}
