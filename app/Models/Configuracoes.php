<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuracoes.
 *
 * @author  TI Ead <ti.ead@ufgd.edu.br>
 *
 * @OA\Schema(
 *     description="Configuracoes model",
 *     title="Configuracoes",
 *     required={"nome", "valor"},
 *     @OA\Xml(
 *         name="Configuracoes"
 *     )
 * )
 */

class Configuracoes extends Model
{
    const CONFIGURACAO_ARQUIVO_SALA_PADRAO = "ARQUIVO_SALA_PADRAO";
    const CONFIGURACAO_ARQUIVO_SAIDA = "ARQUIVO_SAIDA";
    const CONFIGURACAO_PERIODO_LETIVO_PADRAO = "PERIODO_LETIVO_PADRAO";
    const CONFIGURACAO_SUPER_MACRO_PADRAO = "SUPER_MACRO_PADRAO";
    const CONFIGURACAO_EMAIL_SUPORTE = "EMAIL_SUPORTE";
    const CONFIGURACAO_SEPARADOR_EMAIL = "SEPARADOR_EMAIL";
    const CONFIGURACAO_SUFIXO_NOME_SALA = "SUFIXO_NOME_SALA";
    const CONFIGURACAO_REGEX_EMAILS_LIBERADOS = "REGEX_EMAILS_LIBERADOS";
    const CONFIGURACAO_TIMEZONE = "TIMEZONE";

    const CONFIGURACAO_OU_ROOT_DIR = "OU_ROOT_DIR";
    const CONFIGURACAO_AD_COMPANY = "AD_COMPANY";
    const CONFIGURACAO_AD_DEPARTMENT= "AD_DEPARTMENT";
    const CONFIGURACAO_AD_USER_PRINCIPAL_NAME_SUFIXO = "AD_USER_PRINCIPAL_NAME_SUFIXO";
    const CONFIGURACAO_AD_EMAIL_PADRAO_SUFIXO = "AD_EMAIL_PADRAO_SUFIXO";

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
     *     maxLength=31,
     * )
     *
     * @var String
     */
    private $nome;

    /**
     * @OA\Property(
     *     title="Valor",
     *     description="Valor",
     *     maxLength=63,
     * )
     *
     * @var String
     */
    private $valor;

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
        'valor'
    ];

    protected $visible =  [
        'nome',
        'valor'
    ];
}
