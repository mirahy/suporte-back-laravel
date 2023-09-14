<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agenda.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="Agenda model",
 *     title="Agenda",
 *     required={"title", "start", "allDay", "maisDay"},
 *     @OA\Xml(
 *         name="Agenda"
 *     )
 * )
 */

class Agenda extends Model
{
    protected $table = 'agenda';

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
     *     title="Name",
     *     description="User Name",
     *     maximum=191
     * )
     *
     * @var String
     */
    private $title;

    protected $fillable = [
        'title',
        'start',
        'end',
        'allDay',
        'maisDay',
        'backgroundColor'
    ];

    protected $visible =  [
        'id',
        'title',
        'start',
        'end',
        'allDay',
        'maisDay',
        'backgroundColor'
    ];
}
