<?php

namespace App\Validators;

use Illuminate\Http\Request;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class LoginValidator.
 *
 * @package namespace App\Validators;
 */
class LoginValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
          'email'                      => 'bail|required',
          'password'                   => 'bail|required',

        ],
        ValidatorInterface::RULE_UPDATE => [
          'email'                      => 'string',
          'password'                   => 'string',
        ],
      ];

      protected $messages = [
        'email.required'    => 'Email é obrigatório!',
        'password.required' => 'Senha é obrigatoria!',
        'email.string'      => 'Email/Senha incorreto!',
        'password.string'   => 'Email/Senha incorreto!',

        
    ];
}
