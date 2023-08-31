<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\LoginValidator;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService {

    Private $validator;
    Private $repository;


    public function __construct(LoginValidator $validator, UserRepository $repository) {

        $this->validator   = $validator;
        $this->repository  = $repository;
        
    }


    public function auth(Request $request)
    {

        $data = $request->all();

        try {
            //validar campos
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $auth = Auth::attempt($data);

            if($auth){
                $user = $this->repository->FindWhere(['email' => $request->get('email')])->first();
                $token = $user->createToken($request->get('email'));
            }

            return [$token, $user];


        } 
        catch (Exception $e)
        {
          switch (get_class($e)) {
            case QueryException::class      : return $e;
            case ValidatorException::class  : return $e;
            case Exception::class           : return $e;
            default                         : return $e;
          }
        }

    }

    public function usuarioLogado() {
        return Auth::user();
    }

}