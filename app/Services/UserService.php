<?php

namespace App\Services;

use Adldap\Laravel\Facades\Adldap;
use App\Models\User;
use App\Models\Usuario;
use App\Repositories\UserRepository;
use App\Validators\LoginValidator;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService
{

    private $loginValidator;
    private $userValidator;
    private $repository;


    public function __construct(
        LoginValidator $loginValidator,
        UserRepository $repository,
        UserValidator $userValidator
    ) {

        $this->loginValidator       = $loginValidator;
        $this->userValidator        = $userValidator;
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
            if ($auth) {
                $user = $this->repository->FindWhere(['email' => $request->get('email')])->first();
                $tokens = $this->getAllTokensUser($request);
                if ($tokens)
                    $this->revokeAllTokensUser($request);
                $nameToken = $request->get('email') . "_" . hash('md5', now());
                $token = $user->createToken($nameToken);

                return ['token' => $token, 'user' => $user];
            } else {
                $data = ['email' => null, 'password' => null];
                $this->loginValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            }
        } catch (Exception $e) {
            switch (get_class($e)) {
                case QueryException::class:
                    return $e;
                case ValidatorException::class:
                    return $e;
                case Exception::class:
                    return $e;
                default:
                    return $e;
            }
        }
    }

    public function logout(Request $request)
    {
        $this->revokeAllTokensUser($request);
    }

    public function usuarioLogado(Request $request)
    {
        return $request->user();
    }

    public function revokeAllTokensUser(Request $request)
    {
        // Revoke all tokens...
        $request->user()->tokens()->delete();
        $tokens = $this->getAllTokensUser($request);
        if (!empty($tokens[0]))
            return false;
        return true;
    }

    public function revokecurrentAccessTokenUser(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
    }

    public function revokeSpecificTokens(Request $request, $tokenId)
    {
        // Revoke a specific token...
        $request->user()->tokens()->where('id', $tokenId)->delete();
    }

    public function getAllTokensUser(Request $request)
    {
        return $request->user()->tokens;
    }

    public function getFirstLastNameUser()
    {
        $user = Auth::user();
        $name = explode(" ", $user->name);
        $firstName = $name[0];
        $lastname = $name[count($name) - 1];

        return $firstName . ' ' . $lastname;
    }

    public function all()
    {
        return User::all();
    }

    public function create(Request $request)
    {

        $data = $request->all();
        try {
            //validar campos
            $this->userValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);;
            // Salvar usuario
            $usuario = new User();
            $usuario->name = $request->input('name');
            $usuario->email = $request->input('email');
            $usuario->password = 'not set';
            $usuario->permissao = User::PERMISSAO_USUARIO;
            $usuario->save();
        } catch (Exception $e) {
            switch (get_class($e)) {
                case QueryException::class:
                    return $e;
                case ValidatorException::class:
                    return $e;
                case Exception::class:
                    return $e;
                default:
                    return $e;
            }
        }
    }

    public function update($request, $usuario)
    {
        //$usuario->nome = $request->input('nome');
        //$usuario->email = $request->input('email');
        $usuario->permissao = $request->input('permissao');
        $usuario->save();

        return $usuario;
    }

    public function edit($usuario)
    {
        $us = Usuario::findOrFail($usuario);
        return $usuario->with(['setor:id,sigla,campus_id'])->get(['id', 'login', 'nome', 'email', 'permissao', 'setor_id']);
        return $usuario;
    }

    public function show($usuario)
    {
        $us = User::findOrFail($usuario);
        return $us;
    }

    public function delete($usuario)
    {
        if ($usuario->delete()) {
            return new Usuario();
        } else {
            abort(404, 'Usuário não encontrado');
        }
    }

    public function list($request)
    {
        $logado = $this->usuarioLogado($request);
        if ($logado->isAdmin())
            return User::all();
        else
            return [];
    }

    public function usuarioEmail($uid)
    {
        $usuario = User::find($uid);
        $email = "";
        if ($usuario) {
            try {
                $usuarioLdap = Adldap::search()->users()->find($usuario->email);
                if ($usuarioLdap != NULL && isset($usuarioLdap->getAttributes()["mail"]))
                    $email = strtolower($usuarioLdap->getAttributes()["mail"][0]);
            } catch (Exception $e) {
            }
        }

        return $email;
    }

    public function getInfosLdapServidorByDescription($cpf, $createUser)
    {
        $STRING_BAN = "Aluno";
        $STRING_BAN2 = "Desativados";
        if (strlen($cpf) != 11 && strlen($cpf) != 14)
            return null;
        if (strlen($cpf) == 11)
            $cpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
        $us = Adldap::search()->where('description', '=', $cpf)->get();
        $u = null;
        if (count($us)) {
            if (count($us) > 1) {
                for ($i = 0; $i < count($us); $i++) {
                    $brk = true;
                    $memberof = [];
                    if (!isset($us[$i]->getAttributes()["memberof"]))
                        $brk = false;
                    else
                        $memberof = $us[$i]->getAttributes()["memberof"];
                    foreach ($memberof as $m) {
                        if (is_int(strpos($m, $STRING_BAN))) {
                            $brk = false;
                            break;
                        }
                    }

                    $distinguishedname = [];
                    if (!isset($us[$i]->getAttributes()["distinguishedname"]))
                        $brk = false;
                    else
                        $distinguishedname = $us[$i]->getAttributes()["distinguishedname"];
                    foreach ($distinguishedname as $d) {
                        if (is_int(strpos($d, $STRING_BAN2))) {
                            $brk = false;
                            break;
                        }
                    }
                    if ($brk) {
                        $u = $us[$i];
                        break;
                    }
                }
            } else
                $u = $us[0];

            if (!$u)
                return null;
            $usuarioLDAP = [
                'userId' => 0,
                'email' => $u->getAttributes()["mail"][0],
                'username' => $u->getAttributes()["samaccountname"][0],
                'nome' => $u->getAttributes()["displayname"][0],
            ];
            if ($createUser) {
                $usuario = User::where('email', $usuarioLDAP['username'])->first();
                if ($usuario)
                    $usuarioLDAP['userId'] = $usuario->id;
                else {
                    $usuario = new User();
                    $usuario->name = $usuarioLDAP['nome'];
                    $usuario->email = $usuarioLDAP['username'];
                    $usuario->password = 'not set';
                    $usuario->permissao = User::PERMISSAO_USUARIO;
                    $usuario->save();
                    $usuarioLDAP['userId'] = $usuario->id;
                }
            }
            return $usuarioLDAP;
        }
        return null;
    }
}
