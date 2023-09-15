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
     *     title="Title",
     *     description="Title",
     *     maxLength=255,
     * )
     *
     * @var String
     */
    private $title;

    /**
     * @OA\Property(
     *     title="Start",
     *     description="Start",
     *     format="TIMESTAMP",
     *     default="CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
     * )
     *
     * @var string
     */
    private $start;

    /**
     * @OA\Property(
     *     title="End",
     *     description="End",
     *     format="TIMESTAMP",
     *     default="NULL",
     * )
     *
     * @var string
     */
    private $end;

    /**
     * @OA\Property(
     *     title="AllDay",
     *     description="AllDay",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var int
     */
    private $allDay;

    /**
     * @OA\Property(
     *     title="MaisDay",
     *     description="MaisDay",
     *     format="TINYINT",
     *     maxLength=1,
     * )
     *
     * @var int
     */
    private $maisDay;

    /**
     * @OA\Property(
     *     title="BackgroundColor",
     *     description="BackgroundColor",
     *     format="CHAR",
     *     maxLength=7,
     * )
     *
     * @var string
     */
    private $backgroundColor;

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
