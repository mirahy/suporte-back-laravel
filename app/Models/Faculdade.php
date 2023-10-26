<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faculdade.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="Faculdade model",
 *     title="Faculdade",
 *     required={"sigla", "nome", "ativo"},
 *     @OA\Xml(
 *         name="Faculdade"
 *     )
 * )
 */

class Faculdade extends Model
{
    protected $table = 'faculdades';

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var int
     */
    protected $id_f;

    /**
     * @OA\Property(
     *     title="sigla",
     *     description="sigla",
     *     maxLength=15,
     * )
     *
     * @var String
     */
    protected $sigla;

    /**
     * @OA\Property(
     *     title="Nome",
     *     description="Nome",
     *     maxLength=63,
     * )
     *
     * @var String
     */
    protected $nome;

    /**
     * @OA\Property(
     *     title="auto_increment_ref",
     *     description="auto_increment_ref",
     *     default="NULL",
     * )
     *
     * @var int
     */
    protected $auto_increment_ref;

    /**
     * @OA\Property(
     *     title="ativo",
     *     description="ativo",
     *     default="1",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var int
     */
    protected $ativo;
    
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
    protected $created_at;

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
    protected $updated_at;


    protected $fillable = [
        'sigla',
        'nome',
        'auto_increment_ref',
        'ativo'
    ];

    protected $visible = [
        'id',
        'sigla',
        'nome',
        'auto_increment_ref',
        'ativo',
        'cursos'
    ];

    protected $appends = array('cursos');
    public function getCursosAttribute($value) {
        return Curso::where('faculdade_id', $this->id)->get();
    }
}
