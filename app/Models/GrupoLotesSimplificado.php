<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GrupoLotesSimplificado.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="GrupoLotesSimplificado model",
 *     title="GrupoLotesSimplificado",
 *     required={"descricao"},
 *     @OA\Xml(
 *         name="GrupoLotesSimplificado"
 *     )
 * )
 */

class GrupoLotesSimplificado extends Model
{
    protected $table = 'grupo_lotes_simplificados';

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
     *     title="auto_export_estudantes",
     *     description="auto_export_estudantes",
     *     default="0",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var String
     */
    private $auto_export_estudantes;

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
        'auto_export_estudantes'
    ];

    protected $visible = [
        'id',
        'descricao',
        'auto_export_estudantes'
    ];

    
    public function lotesSimplificados()
    { 
        return $this->hasMany(LoteSalasSimplificado::class, 'grupo_id', 'id');
    }
}
