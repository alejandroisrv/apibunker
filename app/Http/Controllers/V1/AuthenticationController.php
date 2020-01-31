<?php

namespace App\Http\Controllers\V1;

use App\Business\Util\Database;
use App\Http\Controllers\Controller;
use App\Jobs\ClientActivationJob;
use App\Models\Activacion;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticationController extends Controller
{

    /**
     * @var JWTAuth
     */
    private $auth;

    /**
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }


    /**
     * @api {post} /authorizations (create a token)
     * @apiDescription create a token
     * @apiGroup Auth
     * @apiPermission none
     * @apiParam {Email} email
     * @apiParam {String} password
     * @apiVersion 0.2.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *         "data": {
     *             "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbHVtZW4tYXBpLWRlbW8uZGV1L2FwaS9hdXRob3JpemF0aW9ucyIsImlhdCI6MTQ4Mzk3NTY5MywiZXhwIjoxNDg5MTU5NjkzLCJuYmYiOjE0ODM5NzU2OTMsImp0aSI6ImViNzAwZDM1MGIxNzM5Y2E5ZjhhNDk4NGMzODcxMWZjIiwic3ViIjo1M30.hdny6T031vVmyWlmnd2aUr4IVM9rm2Wchxg5RX_SDpM",
     *             "expired_at": "2017-03-10 15:28:13",
     *             "refresh_expired_at": "2017-01-23 15:28:13"
     *         }
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 401
     *     {
     *       "error": "User credential is not match"
     *     }
     */

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request)
    {

        try {

            $user = Cliente::where('email', $request->email)->first();

            if ($user) {
                if ($user->verificado === null) {
                    return response()->json(['error' => 'Es necesario que actives tu correo electronico para poder iniciar sesión en tu cuenta'], 422);
                }
            }

            $credentials = $request->only('email', 'password');

            if (!$token = $this->auth->attempt($credentials)) {
                return response()->json(['error' => 'Los datos que has introducido son incorrectos'], 403);
            }

            return response()->json(['token' => $token, 'user' => $user, 'success' => true], 200);
        } catch (\Exepction $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function activate(Request $request)
    {
        $token = Activacion::where('token', $request->token)->first();

        if (!$token) {
            return response()->json(['error' => true, 'mensaje' => 'No existe']);
        }

        $user = Cliente::where("email", $token->email)->first();

        if (!$user) {
            return response()->json(['error' => true, 'mensaje' => 'No existe']);
        }

        $user->verificado = date('Y-m-d H:i:s');

        $user->save();

        $token->delete();

        return response()->json(['error' => false, 'mensaje' => 'Su cuenta se ha activado con exito!']);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombres' => 'bail|required',
            'email' => 'bail|required|email|unique:clientes',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password'
        ], [
            'nombres.required' => 'Debe ingresar el nombre',
            'email.required' => 'Debe ingresar el correo electronico',
            'email.email' => 'Debe ingresar un correo electronico valido',
            'email.unique' => 'El correo ingresado ya se encuentra registrado',
            'password.required' => 'Debe ingresar la contraseña',
            'password.min' => 'La contraseña debe tener un minimo de 6 caracteres',
            'password_confirmation.required' => 'Debe repetir la contraseña',
            'password_confirmation.same' => 'Las contraseñas ingresadas no coinciden',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        try {

            DB::beginTransaction();

            $user = Cliente::create(
                [
                    'nombres' => $request->nombres,
                    'email' => $request->email,
                    'password' =>  app('hash')->make($request->password),
                    'telefono' => $request->telefono,
                ]
            );

            $activacion = Activacion::create([
                'email' => $user->email,
                'token' => Str::random(50),
                'fecha_creacion' => date('Y-m-d H:i:s')
            ]);

            $this->setConfig($activacion->token);

            dispatch(new ClientActivationJob($user, $this->config));

            DB::commit();

            return response()->json(['response' => 'success']);
        } catch (\Exepction $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function setConfig($token = "")
    {
        $this->config = [
            'header_bgcolor' => '#fff',
            'body_bgcolor' => '#eeeeee',
            'activate' =>   'https://activacion.elbunker.pe/?token=' . $token,
            'recover' => config('global.base_url') . 'recuperar/' . $token,
            'logo' => config('global.base_url').'assets/img/logo-rojo.png',
            'www' => 'www.elbunker.pe',
            'copyright' => 'Todos los derechos reservados. El bunker 2020',
            'revista_ip' => 'El bunker',
            'footer_bgcolor' => '#ed1c24',
            'subtitle_bgcolor' => '#ed1c24'
        ];
    }
}
