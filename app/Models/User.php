<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable2;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="User model",
 *     title="User",
 *     required={"name", "email", "password", "permissao"},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */

class User extends Authenticatable2 implements Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens, TransformableTrait;

    const PERMISSAO_ADMINISTRADOR = "ADMINISTRADOR";
    const PERMISSAO_USUARIO = 'USUARIO';
    const PERMISSAO_INATIVO = 'INATIVO';

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
     *     maxLength=191,
     * )
     *
     * @var String
     */
    private $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="User email",
     *      format="email",
      *     maxLength=191,  
     * )
     *
     * @var String
     */
    private $email;


    /**
     * @OA\Property(
     *     title="Permissao",
     *     description="User permission",
     *     default="USUARIO",
     *     enum={"ADMINISTRADOR", "USUARIO", "INATIVO"}, 
     * )
     *
     * @var string
     */
    private $permissao;

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


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permissao'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * muitos para muitos
     */
    public function gestorRecursos()
    {
        return $this->belongsToMany('App\Recurso', 'gestores_recursos','user_id','recurso_id');
    }

    public function isAdmin() {
        return $this->permissao == self::PERMISSAO_ADMINISTRADOR;
    }

    public function isUser() {
        return $this->permissao == self::PERMISSAO_USUARIO;
    }

    public function isInative() {
        return $this->permissao == self::PERMISSAO_INATIVO;
    }
}

