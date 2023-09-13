<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PeriodoLetivoValidator.
 *
 * @package namespace App\Validators;
 */
class PeriodoLetivoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'        => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'        => 'required',
        ],
    ];
    protected $messages = [
        'name.required'         => 'Nome é obrigatório!',
    ];
}
