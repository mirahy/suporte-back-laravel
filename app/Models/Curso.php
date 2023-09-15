<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Curso.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="Curso model",
 *     title="Curso",
 *     required={"nome", "faculdade_id", "ativo"},
 *     @OA\Xml(
 *         name="Curso"
 *     )
 * )
 */

class Curso extends Model
{
    protected $table = 'cursos';

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
     *     title="Nome",
     *     description="Nome",
     *     maxLength=127,
     * )
     *
     * @var String
     */
    private $nome;

    /**
     * @OA\Property(
     *     title="auto_increment_ref",
     *     description="auto_increment_ref",
     *     default="NULL"
     * )
     *
     * @var int
     */
    private $auto_increment_ref;

    /**
     * @OA\Property(
     *     title="faculdade_id",
     *     description="faculdade_id",
     * )
     *
     * @var int
     */
    private $faculdade_id;

    /**
     * @OA\Property(
     *     title="auto_increment_ref",
     *     description="auto_increment_ref",
     *     default="NULL",
     *     maxLength=15,
     * )
     *
     * @var string
     */
    private $curso_key;

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
    private $ativo;

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
        'nome',
        'auto_increment_ref',
        'faculdade_id',
        'curso_key',
        'ativo'
    ];

    protected $visible = [
        'id',
        'nome',
        'auto_increment_ref',
        'faculdade_id',
        'curso_key',
        'ativo'
    ];

    public function faculdade()
    {
        return $this->belongsTo('App\Faculdade');
    }
}
