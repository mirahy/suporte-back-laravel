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
        ValidatorInterface::RULE_UPDATE => [],
      ];

      protected $messages = [
        'email.required' => 'Email e/ou senha inválidos!',
        'password.required' => 'Email e/ou senha inválidos!',
        
    ];
}
