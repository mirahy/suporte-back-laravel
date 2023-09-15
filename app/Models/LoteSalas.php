<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoteSalas.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="LoteSalas model",
 *     title="LoteSalas",
 *     required={"descricao", "periodo_letivo_id", "faculdade_id",  "is_salas_criadas", "is_estudantes_inseridos"},
 *     @OA\Xml(
 *         name="LoteSalas"
 *     )
 * )
 */

class LoteSalas extends Model
{

    protected $table = 'lote_salas';

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
     *     title="descricao",
     *     description="descricao",
     *     maxLength=63,
     * )
     *
     * @var String
     */
    private $descricao;

    /**
     * @OA\Property(
     *     title="periodo_letivo_id",
     *     description="periodo_letivo_id",
     * )
     *
     * @var int
     */
    private $periodo_letivo_id;

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
     *     title="curso_id",
     *     description="curso_id",
     *     default="NULL",
     * )
     *
     * @var int
     */
    private $curso_id;

    /**
     * @OA\Property(
     *     title="is_salas_criadas",
     *     description="is_salas_criadas",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var String
     */
    private $is_salas_criadas;

    /**
     * @OA\Property(
     *     title="is_estudantes_inseridos",
     *     description="is_estudantes_inseridos",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var String
     */
    private $is_estudantes_inseridos;

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
        'descricao',
        'periodo_letivo_id',
        'faculdade_id',
        'curso_id', 
        'is_salas_criadas',
        'is_estudantes_inseridos'
    ];

    protected $visible = [
        'id',
        'descricao',
        'periodo_letivo_id',
        'faculdade_id',
        'curso_id', 
        'is_salas_criadas',
        'is_estudantes_inseridos'
    ];

    public function salas()
    { 
        return $this->hasMany(Sala::class);
    }
}
