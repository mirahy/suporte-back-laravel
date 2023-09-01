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

    Private $loginValidator;
    Private $repository;


    public function __construct(LoginValidator $loginValidator, UserRepository $repository) {

        $this->loginValidator       = $loginValidator;
        $this->repository           = $repository;
        
    }


    public function auth(Request $request)
    {

        $data = $request->all();

        try {
            //validar campos
            $this->loginValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            // realiza login
            $auth = Auth::attempt($data);
            //se usuário foi autenticado, revoga todos o tokens do usuário se existir e retorna o usuário e toke gerado.
            if($auth){
                $user = $this->repository->FindWhere(['email' => $request->get('email')])->first();
                $tokens = $this->getAllTokensUser($request);
                if($tokens)
                    $this->revokeAllTokensUser($request);
                $token = $user->createToken($request->get('email'));

                return [$token, $user];
            }else{
                $data = ['email' => null, 'password' => null];
                $this->loginValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            }    

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

    public function revokeAllTokensUser(Request $request){
         // Revoke all tokens...
        $request->user()->tokens()->delete();
        $tokens = $this->getAllTokensUser($request);
        if (!empty($tokens[0]))
            return false;
        return true;
    }

    public function revokecurrentAccessTokenUser(Request $request){
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
    }

    public function revokeSpecificTokens(Request $request, $tokenId){
        // Revoke a specific token...
        $request->user()->tokens()->where('id', $tokenId)->delete();
    }

    public function getAllTokensUser(Request $request){
        return $request->user()->tokens;
    }




}